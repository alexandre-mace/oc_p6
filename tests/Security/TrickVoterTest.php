<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 02/12/18
 * Time: 20:06
 */

namespace App\Tests\Security;

use App\Entity\Trick;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\Exception\LogicException;

class TrickVoterTest extends TestCase
{
    public function testObjectSupports()
    {
        $user = new User;
        $voter = new ExposedTrickVoter;
        $this->assertEquals(false, $voter->exposedSupports('delete', $user));
    }
    public function testVoteOnAttribute()
    {
        $trick = new Trick;
        $voter = new ExposedTrickVoter;
        $token = $this->createMock('Symfony\Component\Security\Core\Authentication\Token\TokenInterface');
        $token->expects($this->any())
            ->method('getUser')
            ->willReturn(null);
        $this->assertEquals(false, $voter->exposedVoteOnAttribute('delete', $trick, $token));
    }

    public function testVoteOnAttributeLogicException()
    {
        $trick = new Trick;
        $voter = new ExposedTrickVoter;
        $token = $this->createMock('Symfony\Component\Security\Core\Authentication\Token\TokenInterface');
        $user = new User();
        $token->expects($this->any())
            ->method('getUser')
            ->willReturn($user);
        try {
            $voter->exposedVoteOnAttribute('abracadabra', $trick, $token);
        } catch (\LogicException $exception) {
            $this->assertTrue($exception instanceof \LogicException);
        }
    }
}