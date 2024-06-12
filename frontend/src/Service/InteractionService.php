<?php

namespace App\Service;

use App\Entity\Interaction;
use App\Entity\Product;
use App\Entity\User;
use App\Interface\IInteractionService;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
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
    public function sendInteractionsToFlask()
    {
        $interactions = $this->getInteractions();

        $formattedInteractions = array_map(function (Interaction $interaction) {
            $data = [
                'user_id' => $interaction->getUser()->getId(),
                'item_id' => $interaction->getProduct()->getId(),
                'type' => $interaction->getType(),
            ];
            if ($interaction->getType() === 'rating') {
                $data['rating'] = $interaction->getRating();
            }
            return $data;
        }, $interactions);

        // Send interactions to Flask API
        $response = $this->client->post($this->flaskApiUrl . '/train', [
            'json' => ['interactions' => $formattedInteractions]
        ]);

        return $response->getStatusCode() === 200;
    }

    public function getRecommendationsForUser(int $userId, int $numRecommendations = 5)
    {
        // Send request to Flask API for recommendations
        $response = $this->client-pos($this->flaskApiUrl . '/recommend', [
            'json' => [
                'user_id' => $userId,
                'num_recommendations' => $numRecommendations
            ]
        ]);

        if ($response->getStatusCode() === 200) {
            return json_decode($response->getBody()->getContents(), true)['recommended_items'];
        }

        throw new \Exception('Failed to get recommendations from Flask API');
    }

    private function getInteractions(): array
    {
        return $this->em->getRepository(Interaction::class)->findAll();
    }
}