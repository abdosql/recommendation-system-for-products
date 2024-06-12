<?php

namespace App\Controller;

use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShopController extends AbstractController
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    #[Route('/shop', name: 'app_shop')]
    public function index(): Response
    {
        $products = $this->productService->getAllProducts();

        return $this->render('shop.twig', [
            'products' => $products,
        ]);
    }
}
