<?php

namespace App\Handler;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class SecurityConfirmHandler
{
    private $manager;
    private $flashBag;

    public function __construct(EntityManagerInterface $manager, FlashBagInterface $flashBag)
    {
        $this->manager = $manager;
        $this->flashBag = $flashBag;
    }

    public function handle(User $user)
    {
        $user->setConfirmationToken(null);
        $user->setIsActive(true);
        $this->manager->flush();
        $this->flashBag->add('success', "You have successfully confirmed your account, you can now log in !");
        return true;
    }
}
