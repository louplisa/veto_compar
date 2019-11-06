<?php


namespace App\DataFixtures;

use App\Entity\VeterinaryClinic;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class VeterinaryClinicFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $clinic = new VeterinaryClinic();
            $clinic
                ->setName($faker->company)
                ->setStreetNumber($faker->buildingNumber)
                ->setIndiceStreetNumber($faker->randomLetter)
                ->setStreet($faker->streetName)
                ->setComplementary($faker->address)
                ->setZipCode($faker->postcode)
                ->setCity($faker->city)
                ->setPhone($faker->phoneNumber)
                ->setEmail($faker->email);

            $manager->persist($clinic);
        }
        $manager->flush();

    }
}
