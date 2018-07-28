<?php

// src/EventListener/VideoUploadListener.php
namespace App\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use App\Entity\Video;
use App\Service\YoutubeLinkUploader;

class VideoUploadListener
{
    private $uploader;

    public function __construct(YoutubeLinkUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
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
}