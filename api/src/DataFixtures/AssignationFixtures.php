<?php

namespace App\DataFixtures;
 
use App\Entity\Assignation;
use App\Entity\Flight;
use App\Entity\Pilot;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
 
class AssignationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $flights = $manager->getRepository(Flight::class)->findAll();

        $pilots = $manager->getRepository(Pilot::class)->findAll();

        foreach ($flights as $flight) {

                $fixture = (new Assignation())
                    ->setFlight($flight)
                    ->setFinished(False);

                foreach ($pilots as $pilot) {
                    if($pilot->getSkill() >= $flight->getPlane()->getModel()->getComplexity()) {
                        $fixture->setPilot($pilot);

                        //$key = array_search($pilot, $pilots);
                        //unset($pilots[$key]);

                        break;
                    }
                }
                    
                $manager->persist($fixture);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            FlightFixtures::class,
            PilotFixtures::class
        );
    }
}