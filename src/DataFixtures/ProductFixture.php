<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $product1 = new Product();
        $product1->setName('Headphones');
        $product1->setPrice(100);
        $manager->persist($product1);

        $product2 = new Product();
        $product2->setName('Phone case');
        $product2->setPrice(20);
        $manager->persist($product2);

        $manager->flush();
    }
}
