<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
    }
    public function load(ObjectManager $manager)
    {
        $faker= Faker\Factory::create('fr_FR');

        // Création utilisateur
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setEmail($faker->email())
                ->setPrenom($faker->firstName())
                ->setNom($faker->lastName());
            /*  ->setTelephone($this->faker->phoneNumber());*/
            $password = $this->hasher->hashPassword($user, 'p@ssword');
            $user->setPassword($password);
            $manager->persist($user);
        }
        $manager->flush();
    }
}