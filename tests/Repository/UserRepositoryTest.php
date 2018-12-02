<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 02/12/18
 * Time: 16:48
 */

namespace App\Tests\Repository;


use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserRepositoryTest extends WebTestCase
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
        $repository = new UserRepository($registry);
        $this->assertTrue($repository instanceof UserRepository);
    }
    public function testMethods()
    {
        $kernel = self::bootKernel();

        $manager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
        $repository = $manager->getRepository(User::class);
        $this->assertNull($repository->findOneByConfirmationToken('abracadabra'));
        $this->assertNull($repository->findOneByResetToken('abracadabra'));
        $this->assertNull($repository->findOneByUsername('abracadabra'));
    }
}