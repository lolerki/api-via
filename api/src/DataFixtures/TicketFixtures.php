<?php

namespace App\DataFixtures;
 
use App\Entity\Ticket;
use App\Entity\Flight;
use App\Entity\TravelClass;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
 
class TicketFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $flights = $manager->getRepository(Flight::class)->findAll();

        $travelClasses = $manager->getRepository(TravelClass::class)->findAll();

        foreach ($flights as $flight) {
            $places = $flight->getPlane()->getModel()->getPlaces();
            for ($i=0; $i < $places; $i++) { 

                $fixture = (new Ticket())
                    ->setReference($faker->ean13().$flight->getPlane()->getName())
                    ->setFlight($flight)
                    ->setTravelClass($faker->randomElement($travelClasses));
                    
                $manager->persist($fixture);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            FlightFixtures::class,
            TravelClassFixtures::class
        );
    }
}