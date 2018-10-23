<?php

namespace App\Handler;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Form\FormInterface;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class SecurityForgotPasswordHandler
{
    private $manager;
    private $flashBag;

    public function __construct(EntityManagerInterface $manager, FlashBagInterface $flashBag)
    {
        $this->manager = $manager;
        $this->flashBag = $flashBag;
    }

    public function handle(FormInterface $form)
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $username = $form->getData()['username'] ?? '';
            
            $user = $this->manager
                ->getRepository(User::class)
                ->findOneByUsername($username);
            
            if($user instanceof User) {
                $user->setResetToken('1');
                $this->manager->flush();
                $this->flashBag->add('info', 'We\'ve just sent you an email to reset your password !');
                return true;
            }
            throw new NotFoundHttpException("No user correspond to this username.");
            
        }

        return false;
    }
}
