<?php

namespace App\Service;

use App\Entity\Cart;
use App\Entity\Product;
use App\Entity\User;
use App\Interface\ICartService;

class CartService implements ICartService
{

    public function getCartByUserId(User $user): ?Cart
    {
        // TODO: Implement getCartByUserId() method.
    }

    public function addItemToCart(User $user, Product $product, int $quantity): void
    {
        // TODO: Implement addItemToCart() method.
    }

    public function removeItemFromCart(User $user, Product $product): void
    {
        // TODO: Implement removeItemFromCart() method.
    }

    public function clearCart(User $user): void
    {
        // TODO: Implement clearCart() method.
    }
}