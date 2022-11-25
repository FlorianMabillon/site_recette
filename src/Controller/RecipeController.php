<?php

namespace App\Controller;

use Twig\Environment;
use App\Entity\Recipe;
use App\Entity\Comment;
use App\Form\RecipeType;
use App\Form\CommentType;
use App\Service\FileUploader;
use App\Repository\StepRepository;
use App\Repository\UserRepository;
use App\Repository\RecipeRepository;
use App\Repository\CommentRepository;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/recipe")
 */
class RecipeController extends AbstractController
{     
    private $twig;
    private $entityManager;

    public function __construct(Environment $twig, EntityManagerInterface $entityManager)
     {
        
        $this->twig = $twig;
        $this->entityManager = $entityManager;
     }

    /**
     * @Route("/", name="app_recipe_index", methods={"GET"})
     */
    public function index(RecipeRepository $recipeRepository, StepRepository $stepRepository, IngredientRepository $ingredientRepository, UserRepository $userRepository, Request $request): Response
    {
        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipeRepository->findAll(),
            'steps' => $stepRepository->findAll(),
            'ingredients' => $ingredientRepository->findAll(),
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_recipe_new", methods={"GET", "POST"})
     */
    public function new(Request $request, RecipeRepository $recipeRepository, FileUploader $fileUploader ): Response
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $picture = $form->get('picture')->getData();
            if($picture) {
                $fileName = $fileUploader->upload($picture);
                $recipe->setPicture($fileName);
                }

            $user=$this->getUser();
            $recipe->setRecipeUser($user);
            $recipeRepository->add($recipe, true);

            return $this->redirectToRoute('app_recipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('recipe/new.html.twig', [
            'recipe' => $recipe,
            'form' => $form,
        ]);


    }

    /**
     * @Route("/{id}", name="app_recipe_show", methods={"GET", "POST"})
     */
    public function show(Recipe $recipe, StepRepository $stepRepository, IngredientRepository $ingredientRepository, Request $request, CommentRepository $commentRepository, EntityManagerInterface $entityManager ): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe,
            'steps' => $stepRepository,
            'ingredients' => $ingredientRepository,
            'comments' => $commentRepository,
            'comment_form' => $form->createView(),
        ]);
        
        
        if ($form->isSubmitted() && $form->isValid()) {
        $comment->setRecipe($recipe);
        $comment->setCommentUser($user);
        
        $commentRepository->add($comment, true);
        
        $this->entityManager->persist($comment);
        $this->entityManager->flush();
        
        $user=$this->getUser();

        $this->addFlash('message', 'Votre commentaire a bien été envoyé');

            return $this->redirectToRoute('recipe', ['id' => $recipe->getId()], Response::HTTP_SEE_OTHER);
        }
        
    }

    /**
     * @Route("/{id}/edit", name="app_recipe_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Recipe $recipe, RecipeRepository $recipeRepository): Response
    {
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recipeRepository->add($recipe, true);

            return $this->redirectToRoute('app_recipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('recipe/edit.html.twig', [
            'recipe' => $recipe,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_recipe_delete", methods={"POST"})
     */
    public function delete(Request $request, Recipe $recipe, RecipeRepository $recipeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recipe->getId(), $request->request->get('_token'))) {
            $recipeRepository->remove($recipe, true);
        }

        return $this->redirectToRoute('app_recipe_index', [], Response::HTTP_SEE_OTHER);
    }
}
