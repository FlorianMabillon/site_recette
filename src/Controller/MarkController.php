<?php

namespace App\Controller;

use App\Entity\Mark;
use App\Form\MarkType;
use App\Repository\MarkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mark")
 */
class MarkController extends AbstractController
{
    /**
     * @Route("/", name="app_mark_index", methods={"GET"})
     */
    public function index(MarkRepository $markRepository): Response
    {
        return $this->render('mark/index.html.twig', [
            'marks' => $markRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_mark_new", methods={"GET", "POST"})
     */
    public function new(Request $request, MarkRepository $markRepository): Response
    {
        $mark = new Mark();
        $form = $this->createForm(MarkType::class, $mark);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $markRepository->add($mark, true);

            return $this->redirectToRoute('app_mark_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mark/new.html.twig', [
            'mark' => $mark,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_mark_show", methods={"GET"})
     */
    public function show(Mark $mark): Response
    {
        return $this->render('mark/show.html.twig', [
            'mark' => $mark,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_mark_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Mark $mark, MarkRepository $markRepository): Response
    {
        $form = $this->createForm(MarkType::class, $mark);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $markRepository->add($mark, true);

            return $this->redirectToRoute('app_mark_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mark/edit.html.twig', [
            'mark' => $mark,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_mark_delete", methods={"POST"})
     */
    public function delete(Request $request, Mark $mark, MarkRepository $markRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mark->getId(), $request->request->get('_token'))) {
            $markRepository->remove($mark, true);
        }

        return $this->redirectToRoute('app_mark_index', [], Response::HTTP_SEE_OTHER);
    }
}
