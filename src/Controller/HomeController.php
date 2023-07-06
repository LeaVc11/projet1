<?php

namespace App\Controller;

use App\Repository\BlogPostRepository;
use App\Repository\VetementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(VetementRepository $vetementRepository, BlogPostRepository $blogPostRepository ): Response
    {
        return $this->render('home/index.html.twig', [
            'vetements' => $vetementRepository->lastTree(),
            'blogPosts' => $blogPostRepository->lastTreeBlog(),

        ]);
    }
}
