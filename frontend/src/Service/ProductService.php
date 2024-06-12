<?php

namespace App\Service;

use App\Entity\Product;
use App\Interface\IProductService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class ProductService implements IProductService
{
    public function __construct(private EntityManagerInterface $entityManager, private InteractionService $interactionService)
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

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function getRecommendationsForUser(int $userId)
    {
        $recommendations = $this->interactionService->getRecommendationsForUser($userId,5);
        return $this->entityManager->getRepository(Product::class)->findAllRecomendations($recommendations);
    }
}