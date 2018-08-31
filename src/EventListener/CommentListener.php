<?php

// src/EventListener/CommentListener.php

namespace App\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use App\Entity\Comment;
use Symfony\Component\Security\Core\Security;

class CommentListener
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->hydrateAuthor($entity);
    }

    private function hydrateAuthor($entity)
    {
        // upload only works for Comment entities
        if (!$entity instanceof Comment) {
            return;
        }
        $user = $this->security->getUser();
        $entity->setAuthor($user);
    }
}