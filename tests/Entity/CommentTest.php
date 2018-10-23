<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use App\Entity\User;
use App\Entity\Comment;
use App\Entity\Trick;

class CommentTest extends TestCase
{
    public function testEntity()
    {
        $trick = new Trick();
        $comment = new Comment($trick);
        $comment->setContent('Comment test');
        
        $this->assertEquals('Comment test', $comment->getContent());
        $this->assertNull($comment->getId());
    }

    public function testEntityRelations()
    {
        $trick = new Trick();        
        $comment = new Comment($trick);
        $comment->setContent('Comment test');
        $this->assertEquals($trick, $comment->getTrick());

        $author = new User();
        $comment->setAuthor($author);
        $this->assertEquals($author, $comment->getAuthor());

    }
}
