<?php

namespace App\DataFixtures;
 
use App\Entity\Pilot;
use App\Entity\Crime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
 
class PilotFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $crimes = $manager->getRepository(Crime::class)->findAll();

        for ($i=0; $i <  20; $i++) { 
            $fixture = (new Pilot())
                ->setLastName($faker->lastName())
                ->setFirstName($faker->firstName(null))
                ->setSkill($faker->numberBetween($min = 1, $max = 3))
                ->setCrime($crimes[array_rand($crimes, 1)]);

            $manager->persist($fixture);
        }        
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CrimeFixtures::class,
        );
    }
}