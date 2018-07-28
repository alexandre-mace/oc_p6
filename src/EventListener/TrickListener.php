<?php

// src/EventListener/TrickListener.php

namespace App\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use App\Entity\Trick;
use App\Service\Slugger;

class TrickListener
{
    private $slugger;

    public function __construct(Slugger $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->slugify($entity);
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
}