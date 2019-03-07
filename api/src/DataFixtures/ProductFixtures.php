<?php

namespace App\DataFixtures;
 
use App\Entity\Product;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
 
class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $types = $manager->getRepository(Type::class)->findAll();

        for ($i=0; $i < 30; $i++) { 
            $fixture = (new Product())
                ->setName($faker->hexcolor())
                ->setDangerousness($faker->numberBetween($min = 1, $max = 10))
                ->setType($types[array_rand($types, 1)]);
                
            $manager->persist($fixture);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            TypeFixtures::class,
        );
    }
}