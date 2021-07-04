<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeFormType;
use App\Repository\CategoryRepository;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    /**
     * @Route("/", name="recipe")
     */
    public function index(Request $request, EntityManagerInterface $entityManager, CategoryRepository $categoryRepository, IngredientRepository $ingredientRepository): Response
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeFormType::class, $recipe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $categoryRecorded = $recipe->getCategory();
            $category = $categoryRepository->findOneByTitle($categoryRecorded->getTitle());
            if ($category) {
                $recipe->setCategory($category);
            }
            foreach ($recipe->getIngredients() as $ingredientRecorded) {
                $ingredient = $ingredientRepository->findOneByName($ingredientRecorded->getName());
                if($ingredient) {
                    $recipe->removeIngredient($ingredientRecorded);
                    $recipe->addIngredient($ingredient);
                }
            }
            $entityManager->persist($recipe);
            $entityManager->flush();
        }
        return $this->render('recipe/index.html.twig', [
            'form'=>$form->createView(),
        ]);
    }
}
