<?php

namespace App\Service;

use App\Entity\Product;
use App\Interface\IProductService;

class ProductService implements IProductService
{

    public function getProductById(Product $product): ?Product
    {
        // TODO: Implement getProductById() method.
    }

    public function getAllProducts(): array
    {
        // TODO: Implement getAllProducts() method.
    }

    public function createProduct(array $data): Product
    {
        // TODO: Implement createProduct() method.
    }

    public function updateProduct(Product $product, array $data): ?Product
    {
        // TODO: Implement updateProduct() method.
    }

    public function deleteProduct(Product $product): void
    {
        // TODO: Implement deleteProduct() method.
    }
}