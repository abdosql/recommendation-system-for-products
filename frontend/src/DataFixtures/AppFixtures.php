<?php

namespace App\DataFixtures;

use App\Entity\Cart;
use App\Entity\CartItem;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Interaction;
use App\Entity\Product;
use App\Entity\Rating;
use App\Entity\User;
use App\Factory\UserFactory;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Create users
        $users = [];
        for ($i = 0; $i < 50; $i++) {
            $user = new User();
            $user->setUsername($faker->name);
            $user->setPassword('$2y$13$RgSrTjVqoKV4j9wt/psV/.TUwT.m5O4Bkp5lbCD.dg5/ySVjgkR.6');
            $manager->persist($user);
            $users[] = $user;
        }
        // Create categories
        $categories = [];
        for ($i = 0; $i < 10; $i++) {
            $category = new Category();
            $category->setName($faker->word);
            $manager->persist($category);
            $categories[] = $category;
        }
        // Create products
        $products = [];
        for ($i = 0; $i < 50; $i++) {
            $product = new Product();
            $product->setName($faker->word);
            $product->setDescription($faker->sentence);
            $product->setImageUrl($faker->imageUrl(640, 480));
            $product->setPrice($faker->randomFloat(2, 10, 100));
            $product->setCategory($faker->randomElement($categories));
            $manager->persist($product);
            $products[] = $product;
        }

        // Create comments
        for ($i = 0; $i < 100; $i++) {
            $comment = new Comment();
            $comment->setUser($faker->randomElement($users));
            $comment->setProduct($faker->randomElement($products));
            $comment->setContent($faker->sentence);
            $comment->setCreatedAt(DateTimeImmutable::createFromMutable($faker->dateTimeThisYear));
            $manager->persist($comment);
        }

        // Create ratings
        for ($i = 0; $i < 100; $i++) {
            $rating = new Rating();
            $rating->setUser($faker->randomElement($users));
            $rating->setProduct($faker->randomElement($products));
            $rating->setRating($faker->numberBetween(1, 5));
            $rating->setCreatedAt(DateTimeImmutable::createFromMutable($faker->dateTimeThisYear));
            $manager->persist($rating);
        }

        // Create interactions
        $interactionTypes = ['view', 'add_to_cart', 'purchase', 'favorite'];
        for ($i = 0; $i < 200; $i++) {
            $interaction = new Interaction();
            $interaction->setUser($faker->randomElement($users));
            $interaction->setProduct($faker->randomElement($products));
            $interaction->setType($faker->randomElement($interactionTypes));
            $interaction->setInteractionDate(DateTimeImmutable::createFromMutable($faker->dateTimeThisYear));
            $manager->persist($interaction);
        }

        // Create carts and cart items
//        for ($i = 0; $i < 50; $i++) {
//            $cart = new Cart();
//            $cart->setUser($faker->randomElement($users));
//            $manager->persist($cart);
//
//            for ($j = 0; $j < $faker->numberBetween(1, 5); $j++) {
//                $cartItem = new CartItem();
//                $cartItem->setCart($cart);
//                $cartItem->setProduct($faker->randomElement($products));
//                $cartItem->setQuantity($faker->numberBetween(1, 3));
//                $manager->persist($cartItem);
//            }
//        }

        $manager->flush();
    }
}
