<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Vetement;
use App\Services\AbstractFakerFeaturesServices;
use Doctrine\Persistence\ObjectManager;

class VetementFixtures extends AbstractFakerFeaturesServices
{
    public function load(ObjectManager $manager): void
    {
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
    }
    public function getDependencies(): array
    {
        return [
            CategorieFixtures::class
        ];
    }
}