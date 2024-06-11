<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class CartItemRemovedEvent extends Event
{
    public const NAME = 'cart.item_removed';

    private $userId;
    private $productId;

    public function __construct(int $userId, int $productId)
    {
        $this->userId = $userId;
        $this->productId = $productId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }
}
