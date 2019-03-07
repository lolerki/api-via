<?php

namespace App\DataFixtures;
 
use App\Entity\Plane;
use App\Entity\Model;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
 
class PlaneFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $models = $manager->getRepository(Model::class)->findAll();

        for ($i=0; $i < 20; $i++) { 
            $fixture = (new Plane())
                ->setName($faker->regexify('[A-Z]+/[0-9]+/[A-Z]{2,4}'))
                ->setModel($models[array_rand($models, 1)]);
                
            $manager->persist($fixture);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ModelFixtures::class,
        );
    }
}