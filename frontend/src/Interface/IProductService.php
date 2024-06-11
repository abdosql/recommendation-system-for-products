<?php

namespace App\Interface;

use App\Entity\Product;

interface IProductService
{
    public function getProductById(Product $product): ?Product;
    public function getAllProducts(): array;
    public function createProduct(array $data): Product;
    public function updateProduct(Product $product, array $data): ?Product;
    public function deleteProduct(Product $product): void;
}