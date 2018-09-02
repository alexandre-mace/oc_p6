<?php

namespace App\Handler;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;

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
            
            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneByUsername($username);
            
            if($user === null) {
                throw new NotFoundHttpException('No user correspond to this username.');
            }
            $user->setResetToken('1');
            $this->manager->flush();
            return true;
        }

        return false;
    }
}
