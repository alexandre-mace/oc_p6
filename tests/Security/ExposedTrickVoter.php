<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 02/12/18
 * Time: 20:10
 */

namespace App\Tests\Security;


use App\Security\TrickVoter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class ExposedTrickVoter extends TrickVoter
{
    public function exposedSupports($attribute, $subject)
    {
        return $this->supports($attribute, $subject);
    }
    public function exposedVoteOnAttribute($attribute, $object, TokenInterface $token)
    {
        return $this->voteOnAttribute($attribute, $object, $token);
    }
}