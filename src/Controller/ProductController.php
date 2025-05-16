<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/product')]
final class ProductController extends AbstractController
{
    #[Route('', name: 'product_index')]
    public function index(ProductRepository $productRepository, CategoryRepository $categoryRepository): Response
    {
        $products = $productRepository->findBy([], ['createdAt' => 'DESC']);
        $categories = $categoryRepository->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    #[Route('/category/{id}', name: 'product_category')]
    public function category(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        Category $category
    ): Response {

        $products = $productRepository->findBy(
            ['category' => $category],
        );

        $categories = $categoryRepository->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'categories' => $categories,
            'current_category' => $category
        ]);
    }

    #[Route('/{id}', name: 'product_show')]
    public function show(Product $product, ProductRepository $productRepository): Response
    {
        $latestProducts = $productRepository->findBy(
            [],
            ['createdAt' => 'DESC'],
            3
        );

        return $this->render('product/show.html.twig', [
            'product' => $product,
            'latestProducts' => $latestProducts,
        ]);
    }
}
