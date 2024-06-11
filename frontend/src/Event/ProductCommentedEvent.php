<?php

namespace App\Event;

use App\Entity\Comment;
use App\Entity\Product;
use App\Entity\User;
use Symfony\Contracts\EventDispatcher\Event;

class ProductCommentedEvent extends Event
{
    public const NAME = 'product.commented';

    private User $user;
    private Product $product;
    private Comment $comment;

    public function __construct(User $user, Product $product, Comment $comment)
    {
        $this->user = $user;
        $this->product = $product;
        $this->comment = $comment;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getComment(): Comment
    {
        return $this->comment;
    }
}
