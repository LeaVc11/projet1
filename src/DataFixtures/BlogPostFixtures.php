<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\User;
use App\Services\AbstractFakerFeaturesServices;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class BlogPostFixtures extends AbstractFakerFeaturesServices
{

    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
        parent::__construct();
    }

    public function load(ObjectManager $manager): void
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

        // Création d'un blog
        for ($i = 0; $i < 10; $i++) {
            $blogpost = new BlogPost();

            $blogpost->setTitre($this->faker->words(3, true))
                ->setCreatedAt($this->faker->dateTimeBetween('-6 month', 'now'))
                ->setSlug($this->faker->slug(3))
                ->setContenu($this->faker->text(100))
                ->setUser($user);

            $manager->persist($blogpost);

            $manager->flush();
        }
    }
}