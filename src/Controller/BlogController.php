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

        $posts = [];

        echo('<pre><code>');
        print_r($postRepository);
        echo('</pre></code>');

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController'
        ]);
    }

    /*
    #[Route('/blog/{id}', name: 'app_blog_one')]
    public function show(PostRepository $postRepository, int $id): Response
    {

        $post = $postRepository
            -> find($id);

        echo('<pre><code>');
        print_r($post);
        echo('</pre></code>');

        return $this->render('blog/index.html.twig', [
        ]);
    }*/
}
