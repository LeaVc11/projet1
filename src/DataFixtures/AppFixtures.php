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
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $hasher;
    private Generator $faker;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
        $this->faker = Factory::create('fr_FR');
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
        // Création catégorie
        for ($c = 0; $c < 5; $c++) {
            $categorie = new Categorie();

            $categorie->setNom($this->faker->word())
                ->setDescription($this->faker->words(10, true))
                ->setSlug($this->faker->slug(3));

            $manager->persist($categorie);

            $manager->flush();

            // Création vetement
            for ($v = 0; $v < 5; $v++) {
                $vetement = new Vetement();

                $vetement->setCategorie($manager->getRepository(Categorie::class)->find($v+1))
                    ->setNom($this->faker->words('5', true))
                    ->setCreatedAt($this->faker->dateTimeBetween('-6 month', 'now'))
                    ->setSlug($this->faker->slug())
                    ->setDescription($this->faker->text())
                    ->setPrix($this->faker->randomFloat(2, 100, 9999))
                    ->setFile('/img/cat-1.jpg');

                $manager->persist($vetement);

                $manager->flush();
            }
            // Création d'un commentaire
            for ($co = 0; $co < 10; $co++) {
                $commentaire = new Commentaire();

                $commentaire->setAuteur($this->faker->words('5', true))
                    ->setEmail('commentaire@test.com')
                    ->setContenu($this->faker->text(100))
                    ->setCreatedAt($this->faker->dateTimeBetween('-6 month', 'now'));

                $manager->persist($commentaire);

                $manager->flush();

            }
        }
    }

}
