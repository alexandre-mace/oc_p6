<?php

namespace App\Handler;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class SecurityResetPasswordHandler
{
    private $manager;
    private $flashBag;

    public function __construct(EntityManagerInterface $manager, FlashBagInterface $flashBag)
    {
        $this->manager = $manager;
        $this->flashBag = $flashBag;
    }

    public function handle(FormInterface $form, User $user)
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setResetToken(null);
            $this->manager->flush();
            $this->flashBag->add('success', 'You\'ve successfully reset your password !');
            return true;
        }

        return false;
    }
}
