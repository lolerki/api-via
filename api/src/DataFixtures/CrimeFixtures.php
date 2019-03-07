<?php

namespace App\DataFixtures;
 
use App\Entity\Crime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
 
class CrimeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $crimes = ["Pyromaniac", "Pedophile", "Dealer", "Murderer", "Rapist", "War Crimes"];

        for ($i=0; $i <  count($crimes); $i++) { 
            $fixture = (new Crime())
                ->setName($crimes[$i]);
                
            $manager->persist($fixture);
        }        
        $manager->flush();
    }
}