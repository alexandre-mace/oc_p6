<?php

// src/Security/ImageVoter.php
namespace App\Security;

use App\Entity\Image;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class ImageVoter extends Voter
{

        const EDIT = 'edit';
        const DELETE = 'delete';

        protected function supports($attribute, $subject)
        {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, array(self::EDIT, self::DELETE))) {
            return false;
        }

        // only vote on Image objects inside this voter
        if (!$subject instanceof Image) {
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

        $image = $subject;

        switch ($attribute) {
            case self::EDIT:
                return $this->hasRight($image, $user);
            case self::DELETE:
                return $this->hasRight($image, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function hasRight(Image $image, User $user)
    {
        return $user === $image->getAuthor();
    }
}