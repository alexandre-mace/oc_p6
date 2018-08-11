<?php

// src/EventListener/UserListener.php

namespace App\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserListener
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $this->encode($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        $this->encode($entity);
    }

    private function encode($entity)
    {
        // upload only works for User entities
        if (!$entity instanceof User) {
            return;
        }
        $password = $this->encoder->encodePassword($entity, $entity->getPlainPassword());
        $entity->setPassword($password);
    }
}