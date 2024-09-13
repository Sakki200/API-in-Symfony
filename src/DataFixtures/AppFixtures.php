<?php

namespace App\DataFixtures;

use App\Entity\Doctor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $specialisations_medicales = [
            "Cardiologie",
            "Dermatologie",
            "Neurologie",
            "Pédiatrie",
            "Oncologie",
            "Psychiatrie",
            "Chirurgie générale",
            "Gynécologie-obstétrique",
            "Ophtalmologie",
            "Anesthésiologie"
        ];

        $faker = FakerFactory::create('fr_FR');

        for ($i = 0; $i < 30; $i++) {
            $doctor = new Doctor();
            $doctor
                ->setFirstname($faker->firstName())
                ->setLastName($faker->lastName())
                ->setSpeciality($faker->randomElement($specialisations_medicales))
                ->setAddress($faker->streetAddress())
                ->setCity($faker->city())
                ->setZip($faker->postcode())
                ->setPhone($faker->phoneNumber('06########'));

            // Sauvegarde les fake dans la base de données
            $manager->persist($doctor);
        }

        $manager->flush();
    }
}
