<?php

// src/Security/VideoVoter.php
namespace App\Security;

use App\Entity\Video;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class VideoVoter extends Voter
{

        const EDIT = 'edit';
        const DELETE = 'delete';

        protected function supports($attribute, $subject)
        {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, array(self::EDIT, self::DELETE))) {
            return false;
        }

        // only vote on Video objects inside this voter
        if (!$subject instanceof Video) {
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

        $video = $subject;

        switch ($attribute) {
            case self::EDIT:
                return $this->hasRight($video, $user);
            case self::DELETE:
                return $this->hasRight($video, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function hasRight(Video $video, User $user)
    {
        return $user === $video->getAuthor();
    }
}