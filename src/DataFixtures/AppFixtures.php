<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\Categorie;
use App\Entity\Commentaire;
use App\Entity\User;
use App\Entity\Vetement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;

    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Création d'un utilisateur
        $user = new User();
        $user->setEmail('user@test.com')
            ->setPrenom($faker->firstName())
            ->setNom($faker->lastName())
            ->setTelephone($faker->phoneNumber());

        $password = ($this->hasher->hashPassword($user, 'password'));
        $user->setPassword($password);

        $manager->persist($user);

        $manager->flush();

        // Création d'un blog
        for ($i = 0; $i < 10; $i++) {
            $blogpost = new BlogPost();

            $blogpost->setTitre($faker->words(3, true))
                ->setCreatedAt($faker->dateTimeBetween('-6 month', 'now'))
                ->setSlug($faker->slug(3))
                ->setContenu($faker->text(100))
                ->setUser($user);

            $manager->persist($blogpost);

            $manager->flush();
        }
        // Création catégorie
        for ($c = 0; $c < 5; $c++) {
            $categorie = new Categorie();

            $categorie->setNom($faker->word())
                ->setDescription($faker->words(10, true))
                ->setSlug($faker->slug(3));

            $manager->persist($categorie);

            $manager->flush();

            // Création vetement
            for ($v = 0; $v < 10; $v++) {
                $vetement = new Vetement();

                $vetement->setNom($faker->words('5', true))
                    ->setCreatedAt($faker->dateTimeBetween('-6 month', 'now'))
                    ->setSlug($faker->slug())
                    ->setDescription($faker->text())
                    ->setPrix($faker->randomFloat(2, 100, 9999))
                    ->setFile('/img/cat-1.jpg');

                $manager->persist($vetement);

                $manager->flush();
            }
            // Création d'un commentaire
            for ($co = 0; $co < 10; $co++) {
                $commentaire = new Commentaire();

                $commentaire->setAuteur($faker->words('5', true))
                    ->setEmail('commentaire@test.com')
                    ->setContenu($faker->text(100))
                    ->setCreatedAt($faker->dateTimeBetween('-6 month', 'now'));

                $manager->persist($commentaire);

                $manager->flush();

            }
        }
    }

}
