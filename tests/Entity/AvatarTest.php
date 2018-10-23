<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use App\Entity\User;
use App\Entity\Avatar;

class AvatarTest extends TestCase
{
    public function testEntity()
    {
        $avatar = new Avatar();
        $avatar->setName('Avatar test');
        
        $this->assertEquals('Avatar test', $avatar->getName());
        $this->assertNull($avatar->getId());
    }

    public function testEntityRelations()
    {
        $user = new User();        
        $avatar = new Avatar();
        $avatar->setUser($user);
        $this->assertEquals($user, $avatar->getUser());
    }
}
