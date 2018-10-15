<?php

namespace App\Handler;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Trick;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class TrickDeleteHandler
{
    private $manager;
    private $flashBag;

    public function __construct(EntityManagerInterface $manager, FlashBagInterface $flashBag)
    {
        $this->manager = $manager;
        $this->flashBag = $flashBag;
    }

    public function handle(Trick $trick)
    {
        $trick->setMainImage(null);
        $this->manager->remove($trick);
        $this->manager->flush();
        $this->flashBag->add('success', 'The trick has been successfully deleted !');
        return true;
    }
}