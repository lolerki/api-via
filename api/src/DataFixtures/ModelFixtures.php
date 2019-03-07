<?php

namespace App\DataFixtures;
 
use App\Entity\Model;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
 
class ModelFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $names = ['AirAutocar', 'Bouing', 'Tupulev', 'Sokhoï', 'Canvoir', 'Frod'];

        for ($i=0; $i <  count($names); $i++) { 
            $fixture = (new Model())
                ->setName($names[$i])
                ->setWorkers($faker->numberBetween($min = 1, $max = 5))
                ->setPlaces($faker->numberBetween($min = 50, $max = 200))
                ->setSize($faker->numberBetween($min = 1, $max = 3))
                ->setCargo($faker->numberBetween($min = 1, $max = 500))
                ->setComplexity($faker->numberBetween($min = 1, $max = 3));
                
            $manager->persist($fixture);
        }
        $manager->flush();
    }
}