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
        $user = new User();
        $user->setEmail('user@test.com')
            ->setPrenom($this->faker->firstName())
            ->setNom($this->faker->lastName())
            ->setTelephone($this->faker->phoneNumber());
        $password = ($this->hasher->hashPassword($user, 'password'));
        $user->setPassword($password);
        $manager->persist($user);
        $manager->flush();
    }

}