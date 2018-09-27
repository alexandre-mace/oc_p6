<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use App\Entity\Video;
use App\Entity\Trick;

class VideoTest extends TestCase
{
    public function testEntity()
    {
        $video = new Video();
        $video->setUrl('testurl');

        $this->assertEquals('testurl', $video->getUrl());
        $this->assertNull($video->getId());
    }

    public function testEntityRelations()
    {
        $trick = new Trick;
        $video = new Video();        
        $video->setTrick($trick);
        $this->assertEquals($trick, $video->getTrick());
    }
}
