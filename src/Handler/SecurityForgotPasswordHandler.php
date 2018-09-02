<?php

namespace App\Handler;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Form\FormInterface;
use App\Entity\User;

class SecurityForgotPasswordHandler
{

    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function handle(FormInterface $form)
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $username = $form->getData()['username'] ?? '';
            
            $user = $this->manager
                ->getRepository(User::class)
                ->findOneByUsername($username);
            
            if($user) {
                $user->setResetToken('1');
                $this->manager->flush();
                return $user;
            }
            throw new NotFoundHttpException("No user correspond to this username.");
            
        }

        return false;
    }
}
