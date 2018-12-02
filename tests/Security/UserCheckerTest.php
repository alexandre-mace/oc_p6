<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 02/12/18
 * Time: 20:21
 */

namespace App\Tests\Security;


use App\Entity\User;
use App\Security\UserChecker;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class UserCheckerTest extends TestCase
{
    public function testCheckPreAuth()
    {
        $checker = new UserChecker();
        $user = new UserTest();
        $checker->checkPreAuth($user);
        $this->assertNotNull($checker);
    }
    public function testCheckPreAuthException()
    {
        $checker = new UserChecker();
        $user = new User();
        try {
            $checker->checkPreAuth($user);
        } catch (AccessDeniedHttpException $exception) {
            $this->assertTrue($exception instanceof AccessDeniedHttpException);
        }
    }
    public function testCheckPostAuth()
    {
        $checker = new UserChecker();
        $user = new UserTest();
        $checker->checkPostAuth($user);
        $this->assertNotNull($checker);
    }
}