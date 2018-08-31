<?php

// src/EventListener/ImageUploadListener.php
namespace App\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use App\Entity\Image;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\Security;

class ImageUploadListener
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
        // upload only works for Image entities
        if (!$entity instanceof Image) {
            return;
        }
        $user = $this->security->getUser();
        $entity->setAuthor($user);
    }

}