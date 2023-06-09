<?php

namespace App\Tests;

use App\Entity\Categorie;
use App\Entity\Vetement;
use DateTime;
use PHPUnit\Framework\TestCase;

class VetementUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $vetement = new Vetement();
        $datetime = new DateTime();

        $vetement->setNom('nom')
            ->setPrix('20.20')
            ->setDescription('description')
            ->setCreatedAt($datetime)
            ->setSlug('slug')
            ->setFile('file');

        $this->assertTrue($vetement->getNom() === 'nom');
        $this->assertTrue($vetement->getPrix() === '20.20');
        $this->assertTrue($vetement->getDescription() === 'description');
        $this->assertTrue($vetement->getCreatedAt() === $datetime);
        $this->assertTrue($vetement->getSlug() === 'slug');
        $this->assertTrue($vetement->getFile() === 'file');
    }
    public function testIsFalse(): void
    {
        $categorie = new Categorie();
        $vetement = new Vetement();
        $datetime = new DateTime();

        $vetement->setNom('nom')
            ->setPrix(20.20)
            ->setDescription('description')
            ->setCreatedAt($datetime)
            ->setSlug('slug')
            ->setFile('file');


        $this->assertFalse($vetement->getNom() === 'false');
        $this->assertFalse($vetement->getPrix() === 20.20);
        $this->assertFalse($vetement->getDescription() === 'false');
        $this->assertFalse($vetement->getCreatedAt() === new DateTime());
        $this->assertFalse($vetement->getSlug() === 'false');
        $this->assertFalse($vetement->getFile() === 'false');

    }
    public function testIsEmpty(): void
    {
        $vetement = new Vetement();


        $this->assertEmpty($vetement->getNom());
        $this->assertEmpty($vetement->getPrix());
        $this->assertEmpty($vetement->getDescription());
        $this->assertEmpty($vetement->getCreatedAt());
        $this->assertEmpty($vetement->getSlug());
        $this->assertEmpty($vetement->getFile());

    }
}
