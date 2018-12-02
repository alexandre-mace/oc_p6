<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use App\Entity\User;
use App\Entity\Avatar;

class UserTest extends TestCase
{
    public function testEntity()
    {
        $user = new User();
        $user->setUsername('Username test');
        $user->setPlainPassword('Userpassword test');
        $user->setPassword('Userpassword test');
        $user->setEmail('usertest@test.com');
        $user->setIsActive(true);
        $user->setConfirmationToken('token test');
        $user->setResetToken('token test');
        $dateTime = new \DateTime();
        $user->setAddedAt($dateTime);

        $this->assertEquals('Username test', $user->getUsername());
        $this->assertEquals('Userpassword test', $user->getPlainPassword());
        $this->assertEquals('Userpassword test', $user->getPassword());
        $this->assertEquals('usertest@test.com', $user->getEmail());
        $this->assertEquals(true, $user->getIsActive());
        $this->assertEquals('token test', $user->getConfirmationToken());
        $this->assertEquals('token test', $user->getResetToken());
        $this->assertEquals($dateTime, $user->getAddedAt());
        $this->assertNull($user->getId());
    }

    public function testEntityRelations()
    {
        $avatar = new Avatar;
        $user = new User();        
        $user->setAvatar($avatar);
        $this->assertEquals($avatar, $user->getAvatar());
    }
}
