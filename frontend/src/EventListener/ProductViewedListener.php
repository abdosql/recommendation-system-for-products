<?php

namespace App\EventListener;

use App\Entity\Interaction;
use App\Event\ProductViewedEvent;
use Doctrine\ORM\EntityManagerInterface;

class ProductViewedListener
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function onProductViewed(ProductViewedEvent $event)
    {
        $interaction = new Interaction();
        $interaction->setUserId($event->getUserId());
        $interaction->setProductId($event->getProductId());
        $interaction->setType('view');
        $interaction->setInteractionDate(new \DateTime());

        $this->entityManager->persist($interaction);
        $this->entityManager->flush();
    }
}
