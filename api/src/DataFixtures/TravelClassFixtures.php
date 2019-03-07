<?php

namespace App\DataFixtures;
 
use App\Entity\TravelClass;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
 
class TravelClassFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $names = ["Minion", "Hitman", "Lieutenant", "Godfather"];

        for ($i=0; $i <  count($names); $i++) { 
            $fixture = (new TravelClass())
                ->setName($names[$i])
                ->setPrice($faker->numberBetween($min = 300, $max = 20000));

            $manager->persist($fixture);
        }        
        $manager->flush();
    }
}