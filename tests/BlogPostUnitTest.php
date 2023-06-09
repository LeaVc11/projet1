<?php

namespace App\Tests;

use App\Entity\BlogPost;
use PHPUnit\Framework\TestCase;

class BlogPostUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $blogPost = new BlogPost();
        $datetime = new \DateTime();

        $blogPost->setTitre('titre')
            ->setCreatedAt($datetime)
            ->setSlug('slug')
            ->setContenu('contenu');

        $this->assertTrue($blogPost->getTitre() === 'titre');
        $this->assertTrue($blogPost->getCreatedAt() === $datetime);
        $this->assertTrue($blogPost->getContenu() === 'contenu');
        $this->assertTrue($blogPost->getSlug() === 'slug');
    }

    public function testIsFalse(): void
    {
        $blogPost = new BlogPost();
        $datetime = new \DateTime();

        $blogPost->setTitre('titre')
            ->setCreatedAt($datetime)
            ->setSlug('slug')
            ->setContenu('contenu');

        $this->assertFalse($blogPost->getTitre() === 'false');
        $this->assertFalse($blogPost->getCreatedAt() === new \DateTime());
        $this->assertFalse($blogPost->getSlug() === 'false');
        $this->assertFalse($blogPost->getContenu() === 'false');
    }

    public function testIsEmpty(): void
    {
        $blogPost = new BlogPost();
        $datetime = new \DateTime();

        $this->assertEmpty($blogPost->getTitre());
        $this->assertEmpty($blogPost->getCreatedAt());
        $this->assertEmpty($blogPost->getSlug());
        $this->assertEmpty($blogPost->getContenu());
    }

}
