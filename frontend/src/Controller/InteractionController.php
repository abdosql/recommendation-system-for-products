<?php

namespace App\Controller;

use App\Service\InteractionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InteractionController extends AbstractController
{
    private $interactionService;

    public function __construct(InteractionService $interactionService)
    {
        $this->interactionService = $interactionService;
    }

    #[Route('/send_interactions', name: 'send_interactions')]
    public function sendInteractions(): Response
    {
        $success = $this->interactionService->sendInteractionsToFlask();

        return new Response($success ? 'Interactions sent successfully!' : 'Failed to send interactions.', $success ? 200 : 500);
    }
    #[Route('/recommendations/{userId}', name: 'get_recommendations', methods: ['GET'])]

    public function getRecommendations(int $userId): Response
    {
        try {
            $recommendations = $this->interactionService->getRecommendationsForUser($userId);
            return $this->json(['recommended_items' => $recommendations]);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], 500);
        }
    }
}
