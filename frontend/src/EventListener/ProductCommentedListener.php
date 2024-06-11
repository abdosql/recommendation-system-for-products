<?php

namespace App\EventListener;

use App\Entity\Interaction;
use App\Event\ProductCommentedEvent;
use Doctrine\ORM\EntityManagerInterface;

class ProductCommentedListener
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function onProductCommented(ProductCommentedEvent $event)
    {
        $interaction = new Interaction();
        $interaction->setUserId($event->getUserId());
        $interaction->setProductId($event->getProductId());
        $interaction->setType('comment');
        $interaction->setInteractionDate(new \DateTime());

        $this->entityManager->persist($interaction);
        $this->entityManager->flush();
    }
}
