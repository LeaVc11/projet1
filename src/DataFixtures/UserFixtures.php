<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Services\AbstractFakerFeaturesServices;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends AbstractFakerFeaturesServices
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
        parent::__construct();
    }

    public function load(ObjectManager $manager)
    {
        // Création d'un utilisateur
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setEmail($this->faker->email())
                ->setPrenom($this->faker->firstName())
                ->setNom($this->faker->lastName());
            /*  ->setTelephone($this->faker->phoneNumber());*/
            $password = ($this->hasher->hashPassword($user, 'password'));
            $user->setPassword($password);
            $manager->persist($user);
        }
        $manager->flush();
    }

}