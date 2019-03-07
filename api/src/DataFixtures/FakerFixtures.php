<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class FakerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

            $user = new User();
            $user->setEmail('johndoe');
            $user->setLastname($faker->firstName());
            $user->setFirstname($faker->firstName());
            $user->setPassword(password_hash("test", PASSWORD_BCRYPT));
            $manager->persist($user);

        /*for ($i = 0; $i < 20; $i++) {
            $book = new Book();
            $book->setReference($faker->ean13());
            $book->setName($faker->name());
            $book->setDescription($faker->text($maxNbChars = 200));
            $book->setPublicationDate($faker->dateTime());
            $book->setAuthor($author->getAuthor(1));

            $manager->persist($book);
        }*/

        $manager->flush();
    }
}