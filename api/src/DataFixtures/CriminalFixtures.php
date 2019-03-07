<?php

namespace App\DataFixtures;
 
use App\Entity\Criminal;
use App\Entity\Crime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
 
class CriminalFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $crimes = $manager->getRepository(Crime::class)->findAll();

        for ($i=0; $i <  50; $i++) { 
            $fixture = (new Criminal())
                ->setPseudo($faker->userName())
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