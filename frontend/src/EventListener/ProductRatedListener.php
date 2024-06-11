<?php

namespace App\EventListener;

use App\Event\ProductRatedEvent;
use Doctrine\ORM\EntityManagerInterface;

class ProductRatedListener
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function onProductRated(ProductRatedEvent $event)
    {
        $interaction = new Interaction();
        $interaction->setUserId($event->getUserId());
        $interaction->setProductId($event->getProductId());
        $interaction->setType('rate');
        $interaction->setInteractionDate(new \DateTime());

        $this->entityManager->persist($interaction);
        $this->entityManager->flush();
    }
}
