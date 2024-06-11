<?php

namespace App\EventListener;

use App\Event\CartItemRemovedEvent;
use Doctrine\ORM\EntityManagerInterface;

class CartItemRemovedListener
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function onCartItemRemoved(CartItemRemovedEvent $event)
    {
        $interaction = new Interaction();
        $interaction->setUserId($event->getUserId());
        $interaction->setProductId($event->getProductId());
        $interaction->setType('cart_remove');
        $interaction->setInteractionDate(new \DateTime());

        $this->entityManager->persist($interaction);
        $this->entityManager->flush();
    }
}
