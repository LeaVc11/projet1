<?php

namespace App\Tests;

use App\Entity\BlogPost;
use App\Entity\Commentaire;
use App\Entity\Vetement;
use DateTime;
use PHPUnit\Framework\TestCase;

class CommentaireUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $commentaire = new Commentaire();
        $datetime = new DateTime();
        $blogPost = new BlogPost();
        $vetement = new Vetement();

        $commentaire->setAuteur('auteur')
            ->setEmail('true@test.com')
            ->setContenu('contenu')
            ->setBlogpost($blogPost)
            ->setVetement($vetement)
            ->setCreatedAt($datetime);

        $this->assertTrue($commentaire->getAuteur() === 'auteur');
        $this->assertTrue($commentaire->getContenu() === 'contenu');
        $this->assertTrue($commentaire->getEmail() === 'true@test.com');
        $this->assertTrue($commentaire->getCreatedAt() === $datetime);
        $this->assertTrue($commentaire->getBlogpost() === $blogPost);
        $this->assertTrue($commentaire->getVetement() === $vetement);

    }

    public function testIsFalse(): void
    {
        $commentaire = new Commentaire();
        $datetime = new DateTime();
        $blogPost = new BlogPost();
        $vetement = new Vetement();

        $commentaire->setAuteur('false')
            ->setEmail('false@test.com')
            ->setContenu('false')
            ->setCreatedAt(new DateTime())
            ->setBlogpost(new BlogPost())
            ->setVetement(new vetement())

        ;

        $this->assertFalse($commentaire->getAuteur() === 'auteur');
        $this->assertFalse($commentaire->getContenu() === 'contenu');
        $this->assertFalse($commentaire->getEmail() === 'email@test.com');
        $this->assertFalse($commentaire->getCreatedAt() === $datetime);
        $this->assertFalse($commentaire->getBlogpost() === $blogPost);
        $this->assertFalse($commentaire->getVetement() === $vetement);
    }

    public function testIsEmpty(): void
    {
        $commentaire = new Commentaire();

        $this->assertEmpty($commentaire->getAuteur());
        $this->assertEmpty($commentaire->getContenu());
        $this->assertEmpty($commentaire->getEmail());
        $this->assertEmpty($commentaire->getBlogpost());
        $this->assertEmpty($commentaire->getVetement());
    }
}
