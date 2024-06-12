<?php

namespace App\Service\Recommender;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class RecommenderService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function getRecommendations(int $userId, int $numRecommendations): array
    {
        $response = $this->client->request(
            'POST',
            'http://localhost:8000/recommend',
            [
                'json' => [
                    'user_id' => $userId,
                    'num_recommendations' => $numRecommendations
                ]
            ]
        );

        return $response->toArray();
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function trainModel(array $interactions): array
    {
        $response = $this->client->request(
            'POST',
            'http://localhost:8000/train',
            [
                'json' => ['interactions' => $interactions]
            ]
        );

        return $response->toArray();
    }
}
