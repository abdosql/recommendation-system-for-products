<?php

namespace App\Service;

use App\Entity\Product;
use App\Entity\User;
use App\Interface\IInteractionService;

class InteractionService implements IInteractionService
{

    public function logInteraction(User $user, Product $product, string $type): void
    {
        // TODO: Implement logInteraction() method.
    }
}