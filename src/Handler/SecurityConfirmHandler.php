<?php

namespace App\Handler;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class SecurityConfirmHandler
{

    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function handle(User $user)
    {
        $user->setConfirmationToken(null);
        $user->setIsActive(true);
        $this->manager->flush();
        return true;
    }
}
