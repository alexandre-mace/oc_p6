<?php

namespace App\Handler;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Trick;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class TrickDeleteHandler
{
    private $manager;
    private $flashBag;

    public function __construct(EntityManagerInterface $manager, FlashBagInterface $flashBag, AuthorizationCheckerInterface $authChecker)
    {
        $this->manager = $manager;
        $this->flashBag = $flashBag;
        $this->authChecker = $authChecker;
    }

    public function handle(Trick $trick)
    {
        if (!$this->authChecker->isGranted('delete', $trick)) {
            throw new AccessDeniedException();
        }
        $trick->setMainImage(null);
        $this->manager->remove($trick);
        $this->manager->flush();
        $this->flashBag->add('success', 'The trick has been successfully deleted !');
        return true;
    }
}