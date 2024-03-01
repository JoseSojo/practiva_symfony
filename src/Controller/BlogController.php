<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PostRepository;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(PostRepository $postRepository): Response
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'posts' => $postRepository->findAll(),
        ]);
    }

    #[Route('/blog/{id}', name:'app_blog_one')]
    public function show(PostRepository $postRepository, int $id): Response
    {
        return $this->render('blog/one/index.html.twig', [
            'post' => $postRepository->findOneBy(['id' => $id])
        ]);
    }
    
}
