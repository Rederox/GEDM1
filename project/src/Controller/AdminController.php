<?php

namespace App\Controller;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Product;
use App\Form\ProductsType;
use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use App\Form\UserType;


class AdminController extends AbstractController
{
    #[Route('/admin', name: 'acceuil_admin')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $userCount = $entityManager->getRepository(User::class)->count([]);
        $productCount = $entityManager->getRepository(Product::class)->count([]);
        return $this->render('admin/index.html.twig', [
            'homeInformations' => [
                'userCount' => $userCount,
                'productCount' => $productCount,
            ],
        ]);
    }

    #[Route('admin/products', name: 'products_admin')]
    public function products(Request $request, EntityManagerInterface $entityManager, PaginatorInterface $paginator): Response
    {
        $queryBuilder = $entityManager->getRepository(Product::class)->createQueryBuilder('p');

        // Récupérer le terme de recherche
        $search = $request->query->get('search');
        if ($search) {
            $queryBuilder->where('p.product_name LIKE :searchTerm')
                ->setParameter('searchTerm', '%' . $search . '%');
        }

        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1),
            10
        );
        // dump($pagination);
        return $this->render('admin/fds/showProducts.html.twig', [
            'pagination' => $pagination,
        ]);
    }


    #[Route('admin/products/add', name: 'add_product_admin')]
    public function addProduct(EntityManagerInterface $em, Request $request): Response
    {
        $product = new Product();

        $productForm = $this->createForm(ProductsType::class, $product);

        $productForm->handleRequest($request);

        if($productForm->isSubmitted() && $productForm->isValid()){

        $file = $form->get('file')->getData();
        
        $em->persist($product);
        $em->flush();

        
        }

        $this->addFlash('success', 'Produit ajouté avec succès');

    
       
        return $this->render('admin/fds/addProduct.html.twig', [
            'productForm' => $productForm->createView()
        ]);
    }

    #[Route('admin/products/edit/{id}', name: 'edit_product_admin')]
    public function editProduct(Product $product, Request $request, EntityManagerInterface $em): Response
    {
        $productForm = $this->createForm(ProductsType::class, $product);

        $productForm->handleRequest($request);

        if($productForm->isSubmitted() && $productForm->isValid()){

        $em->persist($product);
        $em->flush();

        }

        $this->addFlash('success', 'Produit modifié avec succès');



        return $this->render('admin/fds/editProduct.html.twig', [
            'productForm' => $productForm->createView(),
            'product' => $product,
        ]);
    }
    #[Route('admin/users', name: 'app_user')]
    public function users(Request $request, EntityManagerInterface $entityManager): Response
    {
        $userCount = $entityManager->getRepository(User::class)->count([]);
        $usersList = $entityManager->getRepository(User::class)->findAll();
        
        //dump($usersList);

        
        return $this->render('admin/users/users.html.twig', [
            'homeInformations' => [
                'userCount' => $userCount,
                'usersList' => $usersList,
            ],
        ]);
    }

    #[Route('/admin/user/{id}', name: 'app_users_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('admin/users/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/admin/user/{id}/edit', name: 'app_admin_users_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_user', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/users/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
    #[Route('/admin/user/{id}', name: 'app_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_users_index', [], Response::HTTP_SEE_OTHER);
    }

    
}
