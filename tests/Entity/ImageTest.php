<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use App\Entity\Image;
use App\Entity\Trick;

class ImageTest extends TestCase
{
    public function testEntity()
    {
        $image = new Image();
        $image->setName('test.jpg');
        $image->setMain(true);

        $this->assertEquals('test.jpg', $image->getName());
        $this->assertEquals(true, $image->getMain());
        $this->assertNull($image->getId());
    }

    public function testEntityRelations()
    {
        $trick = new Trick;
        $image = new Image();        
        $image->setTrick($trick);
        $this->assertEquals($trick, $image->getTrick());
    }
}
