<?php

namespace App\Interface;

use App\Entity\Product;
use App\Entity\User;

interface IInteractionService
{
    public function logInteraction(User $user, Product $product, string $type): void;

}