<?php

namespace App\Controller;

use App\Entity\Interaction;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Service\Recommender\RecommenderService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class RecommendationController extends AbstractController
{
    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    #[Route('/recommendations', name: 'get_recommendations', methods: ['GET'])]
    public function recommend(RecommenderService $recommender): Response
    {
        $userId = $this->getUser()->getId(); // Assurez-vous que l'utilisateur est authentifié
        $recommendations = $recommender->getRecommendations($userId, 5);

        return $this->json($recommendations);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    #[Route('/train', name: 'train_model', methods: ['POST'])]
    public function train(RecommenderService $recommender, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->json(['error' => 'User not authenticated'], Response::HTTP_UNAUTHORIZED);
        }

        $interactions = $entityManager->getRepository(Interaction::class)->findBy(['user' => $user]);

        $interactionData = array_map(static function (Interaction $interaction) {
            return [
                'user_id' => $interaction->getUser()->getId(),
                'item_id' => $interaction->getProduct()->getId(),
                'type' => $interaction->getType(),
                'rating' => $interaction->getRating() // Assume there is a getRating method if applicable
            ];
        }, $interactions);

        $result = $recommender->trainModel($interactionData);

        return $this->json($result);
    }
}
