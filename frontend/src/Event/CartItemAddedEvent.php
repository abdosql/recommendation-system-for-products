<?php

namespace App\Event;

use App\Entity\Product;
use App\Entity\User;
use Symfony\Contracts\EventDispatcher\Event;

class CartItemAddedEvent extends Event
{
    public const NAME = 'cart.item_added';

    private User $user;
    private Product $product;

    public function __construct(User $user, Product $product)
    {
        $this->user = $user;
        $this->product = $product;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}
