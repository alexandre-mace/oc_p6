<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use App\Entity\Trick;
use App\Entity\Category;

class CategoryTest extends TestCase
{
    public function testEntity()
    {
        $category = new Category();
        $category->setName('Category test');
        
        $this->assertEquals('Category test', $category->getName());
        $this->assertNull($category->getId());
    }

    public function testEntityRelations()
    {
        $trick = new Trick();        
        $category = new Category();
        $category->addTrick($trick);
        $this->assertEquals($trick, $category->getTricks()->last());
        $category->removeTrick($trick);
        $this->assertArrayNotHasKey(0, $category->getTricks());
    }
}
