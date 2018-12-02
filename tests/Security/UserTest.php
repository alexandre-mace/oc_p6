<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 02/12/18
 * Time: 20:28
 */

namespace App\Tests\Security;


use Symfony\Component\Security\Core\User\UserInterface;

class UserTest implements UserInterface
{
    public function getUsername(){}
    public function getRoles(){}
    public function getPassword(){}
    public function getSalt(){}
    public function eraseCredentials(){}
}