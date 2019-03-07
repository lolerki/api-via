<?php

namespace App\DataFixtures;

use App\Entity\Flight;
use App\Entity\Plane;
use App\Entity\Runway;
use App\Entity\Destination;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
 
class FlightFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $planes = $manager->getRepository(Plane::class)->findAll();
        $runways = $manager->getRepository(Runway::class)->findAll();
        $destinations = $manager->getRepository(Destination::class)->findAll();


        for ($i=0; $i < count($planes); $i++) {
            $destinationsAllowed = $destinations;
            $departureKey = array_rand($destinationsAllowed, 1);
            $departureTime = $faker->dateTimeBetween($startDate = 'now', $endDate = '+5 months', $timezone = null);

            $fixture = (new Flight())
                ->setPlane($planes[array_rand($planes, 1)])
                ->setRunway($runways[array_rand($runways, 1)])
                ->setDeparture($destinationsAllowed[$departureKey]);

            //unset($destinationsAllowed[$departureKey]);

            $fixture->setDestination($destinationsAllowed[array_rand($destinations, 1)])
                ->setDepartureTime($departureTime)
                ->setArrivingTime($faker->dateTimeInInterval($startDate = $departureTime, $interval = '+ 3 days', $timezone = null));

            $manager->persist($fixture);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            PlaneFixtures::class,
            RunwayFixtures::class,
            DestinationFixtures::class
        );
    }
}