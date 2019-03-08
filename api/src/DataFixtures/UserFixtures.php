<?php

namespace App\DataFixtures;
 
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
 
class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $user = (new User())
            ->setEmail('vingt@survingt.com')
            ->setLastname('Uber')
            ->setFirstname('Virgil')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword(password_hash("test", PASSWORD_BCRYPT));
        
        $manager->persist($user);

        $user = (new User())
            ->setEmail('jadore@ceprojet.com')
            ->setLastname('Uber')
            ->setFirstname('Alexandre')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword(password_hash("test", PASSWORD_BCRYPT));
        
        $manager->persist($user);

        $user = (new User())
            ->setEmail('meilleur@groupe.com')
            ->setLastname('Uber')
            ->setFirstname('Irvin')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword(password_hash("test", PASSWORD_BCRYPT));
        
        $manager->persist($user);

        $manager->flush();
    }
}