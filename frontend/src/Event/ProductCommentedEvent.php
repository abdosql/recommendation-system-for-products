<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class ProductCommentedEvent extends Event
{
    public const NAME = 'product.commented';

    private $userId;
    private $productId;
    private $comment;

    public function __construct(int $userId, int $productId, string $comment)
    {
        $this->userId = $userId;
        $this->productId = $productId;
        $this->comment = $comment;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getComment(): string
    {
        return $this->comment;
    }
}
