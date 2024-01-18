<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/category', name: 'category')]
    public function category(): Response
    {
        return $this->render('home/pages/category.html.twig');
    }

    #[Route('/files', name: 'files')]
    public function files(): Response
    {
        return $this->render('home/pages/files.html.twig');
    }

    #[Route('/download', name: 'download')]
    public function download(): Response
    {
        return $this->render('home/pages/download.html.twig');
    }

    #[Route('/settings', name: 'settings')]
    public function settings(): Response
    {
        return $this->render('home/pages/settings.html.twig');
    }

    #[Route('/help', name: 'help')]
    public function help(): Response
    {
        return $this->render('home/pages/help.html.twig');
    }
}
