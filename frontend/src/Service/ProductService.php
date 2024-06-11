<?php

namespace App\Service;

use App\Entity\Product;
use App\Interface\IProductService;
use Doctrine\ORM\EntityManagerInterface;

class ProductService implements IProductService
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function getProductById(Product $product): ?Product
    {
        return $this->entityManager->getRepository(Product::class)->find($product);
    }

    public function getAllProducts(): array
    {
        return $this->entityManager->getRepository(Product::class)->findAll();
    }

    public function createProduct(array $data): Product
    {
    }

    public function updateProduct(Product $product, array $data): ?Product
    {
    }

    public function deleteProduct(Product $product): void
    {
        $product = $this->getProductById($product);
        $this->entityManager->remove($product);
        $this->entityManager->flush();
    }
}