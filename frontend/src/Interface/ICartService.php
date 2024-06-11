<?php

namespace App\Interface;

use App\Entity\Cart;
use App\Entity\Product;
use App\Entity\User;

interface ICartService
{
    public function getCartByUserId(User $user): ?Cart;
    public function addItemToCart(User $user, Product $product, int $quantity): void;
    public function removeItemFromCart(User $user, Product $product): void;
    public function clearCart(User $user): void;
}