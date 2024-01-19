<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\accessFDS;
use App\Entity\Notification;
use App\Entity\Product;
use Knp\Component\Pager\PaginatorInterface;

use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;


class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(EntityManagerInterface $em, Request $request, PaginatorInterface $paginator): Response
    {
        $getUserId = $this->getUser();
        $notifications = $em->getRepository(Notification::class)->findBy(['user' => $getUserId]);
        // dump($notifications);
        $searchTerm = $request->query->get('search', '');

        $queryBuilder = $em->getRepository(accessFDS::class)->createQueryBuilder('a')
            ->leftJoin('a.product', 'p') // Ensure this association is correctly defined in your entity
            ->where('a.user = :user')
            ->setParameter('user', $getUserId);

        if (!empty($searchTerm)) {
            $queryBuilder->andWhere('p.product_name LIKE :term')
                ->setParameter('term', '%' . $searchTerm . '%');
        }


        // Paginate the query
        $page = $request->query->getInt('page', 1); // Get the current page or default to 1
        $pagination = $paginator->paginate(
            $queryBuilder,
            $page,
            8
        );

        // $files = $em->getRepository(accessFDS::class)->findBy(['user' => $getUserId]);
        return $this->render('home/index.html.twig', [
            'files' => $pagination,
            'notifications' => $notifications,
        ]);
    }

    // Dynamic route for product page (product/{id})
    #[Route('/product/{id}', name: 'product_client')]
    public function product(EntityManagerInterface $em, Request $request, $id): Response
    {   
        $getUserId = $this->getUser();
        $product = $em->getRepository(Product::class)->find($id);
        $accessFDS = $em->getRepository(accessFDS::class)->findOneBy(['user' => $getUserId, 'product' => $product]);
    
        if ($accessFDS == null) {
            return $this->redirectToRoute('homepage');
        }

        return $this->render('home/pages/product.html.twig', [
            'product' => $product,
            'id' => $id,
        ]);
    }

    #[Route('/help', name: 'help')]
    public function help(): Response
    {
        return $this->render('home/pages/help.html.twig');
    }

    #[Route("/telecharger-pdf/{url}", name: 'telecharger_pdf')]
    public function telecharger(string $url, KernelInterface $kernel): Response
    {
        // Assuming PDFs are stored in 'public/images/products/', adjust if necessary
        $projectDir = $kernel->getProjectDir();
        $cheminFichier = $projectDir . '/public/images/products/' . $url;

        // Check if file exists and is readable
        if (!is_readable($cheminFichier)) {
            throw new FileNotFoundException('File not found or not readable: ' . $url);
        }

        // Read the file content
        $content = file_get_contents($cheminFichier);

        // Create and return the response
        $response = new Response($content);
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . basename($url) . '"');

        return $this->file($cheminFichier, null, ResponseHeaderBag::DISPOSITION_INLINE);
        // return $response;
    }

    #[Route("/view-pdf/{url}", name: 'view_pdf')]
    public function view(string $url, KernelInterface $kernel): Response
    {
        // Assuming PDFs are stored in 'public/images/products/', adjust if necessary
        $projectDir = $kernel->getProjectDir();
        $cheminFichier = $projectDir . '/public/images/products/' . $url;

        // Check if file exists and is readable
        if (!is_readable($cheminFichier)) {
            throw new FileNotFoundException('File not found or not readable: ' . $url);
        }

        return $this->file($cheminFichier, null, ResponseHeaderBag::DISPOSITION_INLINE);
    }

}
