<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Commentaire;
use App\Entity\Vetement;
use App\Services\AbstractFakerFeaturesServices;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;


class CategorieFixtures extends AbstractFakerFeaturesServices
{

    public function load(ObjectManager $manager): void
    {
        // Création catégorie
        for ($c = 0; $c < 5; $c++) {
            $categorie = new Categorie();
            $categorie->setNom($this->faker->word())
                ->setDescription($this->faker->words(10, true))
                ->setSlug($this->faker->slug(3));
            $manager->persist($categorie);
        }
        $manager->flush();
    }

}
