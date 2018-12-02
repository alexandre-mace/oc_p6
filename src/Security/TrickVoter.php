<?php

// src/Security/TrickVoter.php
namespace App\Security;

use App\Entity\Trick;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class TrickVoter extends Voter
{
    const EDIT = 'edit';
    const DELETE = 'delete';

    protected function supports($attribute, $subject)
        {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, array(self::EDIT, self::DELETE))) {
            return false;
        }

        // only vote on Trick objects inside this voter
        if (!$subject instanceof Trick) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        $trick = $subject;

        switch ($attribute) {
            case self::EDIT:
                return $this->hasRight($trick, $user);
            case self::DELETE:
                return $this->hasRight($trick, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function hasRight(Trick $trick, User $user)
    {
        return $user === $trick->getAuthor();
    }
}