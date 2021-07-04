<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    /**
     * @Route("/", name="recipe")
     */
    public function index(): Response
    {
        $message = 'Hello MF';
        return $this->render('recipe/index.html.twig', [
            'message' => $message,
        ]);
    }
}
