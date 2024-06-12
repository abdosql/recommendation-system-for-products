<?php

namespace App\Service;

use App\Entity\Interaction;
use App\Entity\Product;
use App\Entity\User;
use App\Interface\IInteractionService;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class InteractionService implements IInteractionService
{
    private $client;
    private $em;
    private $flaskApiUrl;

    public function __construct(HttpClientInterface $client, EntityManagerInterface $em, string $flaskApiUrl)
    {
        $this->client = $client;
        $this->em = $em;
        $this->flaskApiUrl = $flaskApiUrl;
    }

    public function logInteraction(User $user, Product $product, string $type): void
    {
        // TODO: Implement logInteraction() method.
    }
g

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws \Exception
     */
    public function getRecommendationsForUser(int $userId, int $numRecommendations = 5): array
    {
        // Send request to Flask API for recommendations
        $response = $this->client->request('POST', $this->flaskApiUrl . '/recommend', [
            'json' => [
                'user_id' => $userId,
                'num_recommendations' => $numRecommendations
            ]
        ]);

        if ($response->getStatusCode() === 200) {
            return $response->toArray()['recommended_items'];
        }

        throw new \Exception('Failed to get recommendations from Flask API');
    }

    private function getInteractions(): array
    {
        return $this->em->getRepository(Interaction::class)->findAll();
    }
}