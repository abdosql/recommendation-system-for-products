<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WishListController extends AbstractController
{
    #[Route('/wishlist', name: 'app_wishlist')]
    public function index(): Response
    {
        return $this->render('wishlist.twig', [
            'controller_name' => 'WishListController',
        ]);
    }
}
