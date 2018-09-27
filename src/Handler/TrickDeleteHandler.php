<?php

namespace App\Handler;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Trick;

class TrickDeleteHandler
{

    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function handle(Trick $trick)
    {
        $trick->setMainImage(null);
        $this->manager->remove($trick);
        $this->manager->flush();
        return true;
    }
}