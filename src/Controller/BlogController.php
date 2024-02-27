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

        # $posts = $postRepository->findAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController'
        ]);
    }

    #[Route('/blog/create', name: 'app_create_blog')]
    public function create(): Response
    {

        return $this->render('blog/create.html.twig', [
            'controller_name' => 'BlogCreateController'
        ]);
    }
}
