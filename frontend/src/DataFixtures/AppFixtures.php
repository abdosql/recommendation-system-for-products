<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Factory\ProductFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne([
            'username' => 'admin',
            'password' => '$2y$13$RgSrTjVqoKV4j9wt/psV/.TUwT.m5O4Bkp5lbCD.dg5/ySVjgkR.6',
        ]);
        UserFactory::createMany(50);
        $categories = ['Electronics', 'Books', 'Clothing', 'Home', 'Sports'];
        for ($i = 0; $i < 5; $i++) {
            ProductFactory::createOne([
                'name' => 'Product ' . $i,
                'category' => $categories[$i],
            ]);
        }
        $manager->flush();
    }
}
