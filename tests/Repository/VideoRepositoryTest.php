<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 02/12/18
 * Time: 16:48
 */

namespace App\Tests\Repository;


use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VideoRepositoryTest extends WebTestCase
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
        $repository = new VideoRepository($registry);
        $this->assertTrue($repository instanceof VideoRepository);
    }
}