<?php

namespace App\DataFixtures;
 
use App\Entity\Runway;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
 
class RunwayFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i=0; $i < 5; $i++) { 
            $fixture = (new Runway())
                ->setName($faker->streetName().' Runway')
                ->setSize($faker->numberBetween($min = 1, $max = 3));
            
            $manager->persist($fixture);
        }
        $manager->flush();
    }
}