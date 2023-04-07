<?php

namespace App\DataFixtures;

use App\Entity\CountryTaxCode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CountryTaxCodeFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $code1 = new CountryTaxCode();
        $code1->setCode('DE');
        $code1->setCountry('Germany');
        $code1->setTax(19);
        $manager->persist($code1);

        $code2 = new CountryTaxCode();
        $code2->setCode('IT');
        $code2->setCountry('Italy');
        $code2->setTax(22);
        $manager->persist($code2);

        $code3 = new CountryTaxCode();
        $code3->setCode('GR');
        $code3->setCountry('Greece');
        $code3->setTax(24);
        $manager->persist($code3);

        $manager->flush();
    }
}
