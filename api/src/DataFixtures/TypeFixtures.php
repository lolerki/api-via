<?php

namespace App\DataFixtures;
 
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
 
class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $crimes = ["Firearm", "Drug", "Child", "Bomb", "Organ"];

        for ($i=0; $i <  count($crimes); $i++) { 
            $fixture = (new Type())
                ->setName($crimes[$i]);
                
            $manager->persist($fixture);
        }

        $manager->flush();
    }
}