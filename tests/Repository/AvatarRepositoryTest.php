<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 02/12/18
 * Time: 16:48
 */

namespace App\Tests\Repository;


use App\Repository\AvatarRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AvatarRepositoryTest extends WebTestCase
{
    public function testInstanciate()
    {
        $metadata = $this->createMock('Doctrine\ORM\Mapping\ClassMetadata');
        $manager = $this->createMock('Doctrine\ORM\EntityManagerInterface');
        $manager->expects($this->any())
            ->method('getClassMetadata')
            ->willReturn($metadata);
        $registry = $this->createMock('Symfony\Bridge\Doctrine\RegistryInterface');
        $registry->expects($this->any())
            ->method('getManagerForClass')
            ->willReturn($manager);
        $repository = new AvatarRepository($registry);
        $this->assertTrue($repository instanceof AvatarRepository);
    }
}