<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class ProductRatedEvent extends Event
{
    public const NAME = 'product.rated';

    private $userId;
    private $productId;
    private $rating;

    public function __construct(int $userId, int $productId, int $rating)
    {
        $this->userId = $userId;
        $this->productId = $productId;
        $this->rating = $rating;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getRating(): int
    {
        return $this->rating;
    }
}
