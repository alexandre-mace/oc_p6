<?php

namespace App\Tests\Entity;

use App\Entity\Image;
use App\Entity\Video;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use App\Entity\User;
use App\Entity\Trick;
use App\Entity\Comment;
use App\Entity\Category;

class TrickTest extends TestCase
{
    public function testEntity()
    {
        $trick = new Trick();
        $trick->setName('Trick test');
        $trick->setDescription('Trick test');
        $dateTime = new \DateTime();
        $trick->setAddedAt($dateTime);
        
        $this->assertEquals('Trick test', $trick->getName());
        $this->assertEquals('Trick test', $trick->getDescription());
        $this->assertEquals($dateTime, $trick->getAddedAt());
        $this->assertNull($trick->getId());
    }

    public function testEntityRelations()
    {
        $trick = new Trick();
        $trick->setName('Trick test');
        $trick->setDescription('Trick test');

        $author = new User();
        $author->setUsername('c');
        $trick->setAuthor($author);
        $this->assertEquals($author, $trick->getAuthor());

        $category = new Category;
        $category->setName('Category test');
        $trick->addCategory($category);
        $this->assertEquals($category, $trick->getCategories()->first());

        $comment = new Comment($trick);
        $comment->setContent('Comment test');
        $trick->addComment($comment);
        $this->assertEquals($comment, $trick->getComments()->first());
        $trick->removeComment($comment);
        $this->assertArrayNotHasKey(0, $trick->getComments());

        $image = new Image();
        $trick->addImage($image);
        $this->assertEquals($image, $trick->getImages()->first());
        $trick->removeImage($image);
        $this->assertArrayNotHasKey(0, $trick->getImages());

        $video = new Video();
        $trick->addVideo($video);
        $this->assertEquals($video, $trick->getVideos()->first());
        $trick->removeVideo($video);
        $this->assertArrayNotHasKey(0, $trick->getVideos());
    }
}
