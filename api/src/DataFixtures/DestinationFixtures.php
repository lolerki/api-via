<?php

namespace App\DataFixtures;
 
use App\Entity\Destination;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
 
class DestinationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i=0; $i < 20; $i++) { 
            $fixture = (new Destination())
                ->setName($faker->city())
                ->setCountry($faker->country());
                
            $manager->persist($fixture);
        }
        $manager->flush();
    }
}