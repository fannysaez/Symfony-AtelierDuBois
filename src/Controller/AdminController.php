<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

#[IsGranted('ROLE_ADMIN')]
final class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin_dashobard')]
    public function index(EntityManagerInterface $entityManager, Request $request, ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();

        return $this->render('admin/index.html.twig',[
        'products' => $products,
        ]);
    }
    
}

