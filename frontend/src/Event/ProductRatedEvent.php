<?php

namespace App\Event;

use App\Entity\Product;
use App\Entity\Rating;
use App\Entity\User;
use Symfony\Contracts\EventDispatcher\Event;

class ProductRatedEvent extends Event
{
    public const NAME = 'product.rated';

    private User $user;
    private Product $product;
    private Rating $rating;

    public function __construct(User $user, Product $product, Rating $rating)
    {
        $this->user = $user;
        $this->product = $product;
        $this->rating = $rating;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }


    public function getRating(): Rating
    {
        return $this->rating;
    }
}
