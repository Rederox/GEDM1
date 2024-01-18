<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\accessFDS;
use App\Entity\Product;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(EntityManagerInterface $em, Request $request): Response
    {
        $getUserId = $this->getUser()->getId();
        $files = $em->getRepository(accessFDS::class)->findBy(['user' => $getUserId]);
        return $this->render('home/index.html.twig', [
            'files' => $files,
        ]);
    }

    #[Route('/help', name: 'help')]
    public function help(): Response
    {
        return $this->render('home/pages/help.html.twig');
    }
}
