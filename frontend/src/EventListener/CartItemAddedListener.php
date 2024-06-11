<?php

namespace App\EventListener;

use App\Event\CartItemAddedEvent;
use Doctrine\ORM\EntityManagerInterface;

class CartItemAddedListener
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function onCartItemAdded(CartItemAddedEvent $event)
    {
        $interaction = new Interaction();
        $interaction->setUserId($event->getUserId());
        $interaction->setProductId($event->getProductId());
        $interaction->setType('cart_add');
        $interaction->setInteractionDate(new \DateTime());

        $this->entityManager->persist($interaction);
        $this->entityManager->flush();
    }
}
