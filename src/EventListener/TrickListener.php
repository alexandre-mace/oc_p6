<?php

// src/EventListener/TrickListener.php

namespace App\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use App\Entity\Trick;
use App\Service\Slugger;
use Symfony\Component\Security\Core\Security;

class TrickListener
{
    private $slugger;
    private $security;

    public function __construct(Slugger $slugger, Security $security)
    {
        $this->slugger = $slugger;
        $this->security = $security;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->slugify($entity);
        $this->hydrateAuthor($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->slugify($entity);
    }

    private function slugify($entity)
    {
        // upload only works for Trick entities
        if (!$entity instanceof Trick) {
            return;
        }

        $name = $entity->getName();

        $slug = $this->slugger->slugify($name);
        $entity->setSlug($slug);
    }
    
    private function hydrateAuthor($entity)
    {
        // upload only works for Trick entities
        if (!$entity instanceof Trick) {
            return;
        }
        $user = $this->security->getUser();
        $entity->setAuthor($user);
    }
}