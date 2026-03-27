<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    #[Route('/category/create',name:'app_category_create')]
    public function create(EntityManagerInterface $entityManager, Request $request) : Response
    {
        $category = new Category();

        // Create the form
        $form = $this->createForm(CategoryType::class,$category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // Get data from the form
            $newCategory = $form->getData();

            $entityManager->persist($newCategory);

            $entityManager->flush();

            $this->addFlash("notice","The category is added");

            return $this->redirectToRoute("app_posts");
        }
        
        return $this->render("category/create.html.twig",[
            'form' => $form
        ]);
    }
}
