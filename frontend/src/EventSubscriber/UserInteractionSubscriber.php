<?php

namespace App\EventSubscriber;

use App\Interface\IInteractionService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Event\ProductViewedEvent;
use App\Event\ProductCommentedEvent;
use App\Event\ProductRatedEvent;
use App\Event\CartItemAddedEvent;
use App\Event\CartItemRemovedEvent;

class UserInteractionSubscriber implements EventSubscriberInterface
{

    public function __construct(private IInteractionService $interactionService)
    {}

    public static function getSubscribedEvents(): array
    {
        return [
            ProductViewedEvent::NAME => 'onProductViewed',
            ProductCommentedEvent::NAME => 'onProductCommented',
            ProductRatedEvent::NAME => 'onProductRated',
            CartItemAddedEvent::NAME => 'onCartItemAdded',
            CartItemRemovedEvent::NAME => 'onCartItemRemoved',
        ];
    }

    public function onProductViewed(ProductViewedEvent $event): void
    {
        $this->interactionService->logInteraction($event->getUser(), $event->getProduct(), 'view');
    }

    public function onProductCommented(ProductCommentedEvent $event): void
    {
        $this->interactionService->logInteraction($event->getUser(), $event->getProduct(), 'comment');

    }

    public function onProductRated(ProductRatedEvent $event): void
    {
        $this->interactionService->logInteraction($event->getUser(), $event->getProduct(), 'rate');

    }

    public function onCartItemAdded(CartItemAddedEvent $event): void
    {
        $this->interactionService->logInteraction($event->getUser(), $event->getProduct(), 'cart_add');
    }

    public function onCartItemRemoved(CartItemRemovedEvent $event): void
    {
        $this->interactionService->logInteraction($event->getUser(), $event->getProduct(), 'cart_remove');

    }
}
