<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PostController extends AbstractController
{

    #[Route('/post/create',name:'app_post_create',methods:['GET','POST'])]
    public function create(EntityManagerInterface $entityManager, Request $request) : Response 
    {
        $post = new Post();
        $post->setCreatedAt(new \DateTimeImmutable());

        $form = $this->createForm(PostType::class,$post);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $newPost = $form->getData();

            $entityManager->persist($newPost);

            $entityManager->flush();

            $this->addFlash("notice","The post is created");

            return $this->redirectToRoute("app_posts");
        }

        return $this->render('/post/create.html.twig',[
            "form" => $form
        ]);
    }

    #[Route('/post/{id}', name: 'app_post_show')]
    public function show(Post $post) : Response {
        return $this->render('/post/show.html.twig',[
            'post' => $post
        ]);
    }

    #[Route('/post/edit/{id}',name:'app_post_edit')]
    public function edit(EntityManagerInterface $entityManager, Post $post, Request $request) : Response 
    {
        $form = $this->createForm(PostType::class,$post);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->flush();
            $this->addFlash("notice","The post is updated");
            return $this->redirectToRoute('app_posts');
        }

        return $this->render('/post/edit.html.twig',[
            'form' => $form
        ]);
    }

    #[Route('/post/delete/{id}',name:'app_post_delete')]
    public function delete(EntityManagerInterface $entityManager, Post $post) : Response 
    {
        $entityManager->remove($post);
        $entityManager->flush();

        $this->addFlash("notice","The post is deleted");
        return $this->redirectToRoute("app_posts");
    }

    #[Route('/', name: 'app_posts')]
    public function index(PostRepository $postRepository, CategoryRepository $categoryRepository): Response
    {
        $posts = $postRepository->findAll();
        $categories = $categoryRepository->findAll();

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

}
