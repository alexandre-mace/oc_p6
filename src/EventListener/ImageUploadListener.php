<?php

// src/EventListener/ImageUploadListener.php
namespace App\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use App\Entity\Image;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\Security;

class ImageUploadListener
{
    private $uploader;
    private $security;

    public function __construct(FileUploader $uploader, Security $security)
    {
        $this->uploader = $uploader;
        $this->security = $security;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->hydrateAuthor($entity);
        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    private function uploadFile($entity)
    {
        // upload only works for Image entities
        if (!$entity instanceof Image) {
            return;
        }

        $file = $entity->getFile();

        // only upload new files
        if ($file instanceof UploadedFile) {
            $fileName = $this->uploader->upload($file);
            $entity->setFile($fileName);
        }
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