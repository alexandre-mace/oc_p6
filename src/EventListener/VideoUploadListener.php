<?php

// src/EventListener/VideoUploadListener.php
namespace App\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use App\Entity\Video;
use App\Service\YoutubeLinkUploader;
use Symfony\Component\Security\Core\Security;


class VideoUploadListener
{
    private $uploader;
    private $security;

    public function __construct(YoutubeLinkUploader $uploader, Security $security)
    {
        $this->uploader = $uploader;
        $this->security = $security;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
        $this->hydrateAuthor($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    private function uploadFile($entity)
    {
        // upload only works for Video entities
        if (!$entity instanceof Video) {
            return;
        }

        $url = $entity->getUrl();

        // only upload new files
        if (!preg_match('/embed/', $url)) {
            $embedUrl = $this->uploader->getLink($url);
            $entity->setUrl($embedUrl);
        }
    }

    private function hydrateAuthor($entity)
    {
        // upload only works for Video entities
        if (!$entity instanceof Video) {
            return;
        }
        $user = $this->security->getUser();
        $entity->setAuthor($user);
    }
}