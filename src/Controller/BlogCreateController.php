<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\BlogCreateFormType;
use App\Entity\Post;

class BlogCreateController extends AbstractController
{

    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }

    #[Route('/blog/create', name: 'app_blog_create')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $post = new Post();
        $form = $this->createForm(BlogCreateFormType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setTitle($form->get('title')->getData());
            $post->setContent($form->get('content')->getData());
            $post->setIdUser($form->get('slug')->getData());

            $post->setSlug('abc');
            $post->setIsDraft('0');

            $entityManager->persist($post);
            $entityManager->flush();

            return new RedirectResponse($this->urlGenerator->generate('app_blog'));
        }

        return $this->render('blog_create/index.html.twig', [
            'controller_name' => 'BlogCreateController',
            'postForm' => $form->createView(),
        ]);
    }
}
