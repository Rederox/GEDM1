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


class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(EntityManagerInterface $em, Request $request, PaginatorInterface $paginator): Response
    {   
        $getUserId = $this->getUser()->getId();
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
        $product = $em->getRepository(Product::class)->find($id);
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
    public function telecharger($url): Response
    {
        // Implement the logic to fetch the PDF file based on the URL
        // For example, if your PDFs are stored in a specific directory, you can use that.

        // A changer 
        $cheminFichier = '/chemin/vers/votre/dossier/' . $url;

        $response = new Response();
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . basename($url) . '"');
        $response->setContent(file_get_contents($cheminFichier));

        return $response;
    }

}
