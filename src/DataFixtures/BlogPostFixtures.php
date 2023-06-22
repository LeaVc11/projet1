<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\User;
use App\Services\AbstractFakerFeaturesServices;
use Doctrine\Persistence\ObjectManager;


class BlogPostFixtures extends AbstractFakerFeaturesServices
{



    public function load(ObjectManager $manager): void
    {

        // Création d'un blog
        for ($i = 0; $i < 10; $i++) {
            $blogpost = new BlogPost();
            $blogpost->setTitre($this->faker->words(3, true))
                ->setCreatedAt($this->faker->dateTimeBetween('-6 month', 'now'))
                ->setSlug($this->faker->slug(3))
                ->setContenu($this->faker->text(100))
                ->setUser($manager->getRepository(User::class)->find(1));

            $manager->persist($blogpost);

            $manager->flush();
        }

    }
    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }
}