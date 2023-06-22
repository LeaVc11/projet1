<?php

namespace App\DataFixtures;

use App\Entity\Commentaire;
use App\Services\AbstractFakerFeaturesServices;
use Doctrine\Persistence\ObjectManager;

class CommentairesFixtures extends AbstractFakerFeaturesServices
{
    public function load(ObjectManager $manager): void
    {
        // Création d'un commentaire
        for ($co = 0; $co < 10; $co++) {
            $commentaire = new Commentaire();
            $commentaire->setAuteur($this->faker->words('5', true))
                ->setEmail('commentaire@test.com')
                ->setContenu($this->faker->text(100))
                ->setCreatedAt($this->faker->dateTimeBetween('-6 month', 'now'));
            $manager->persist($commentaire);
        }
        $manager->flush();
    }
}