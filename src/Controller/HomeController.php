<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

/**
* @Route("/profil", name="app_user_profil")
*/
    public function profil(RecipeRepository $recipeRepository): Response
    {
        return $this->render('user/profil.html.twig', [
            'user' => $this->getUser(),
            'recipes' => $recipeRepository->findAll(),
        ]);
    }
}
