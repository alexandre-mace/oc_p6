<?php

// src/EventListener/UserListener.php

namespace App\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Service\TokenGenerator;

class UserListener
{
    private $encoder;
    private $tokenGenerator;
    private $mailer;
    private $twig;

    public function __construct(UserPasswordEncoderInterface $encoder, TokenGenerator $tokenGenerator, \Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->encoder = $encoder;
        $this->tokenGenerator = $tokenGenerator;
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $this->encode($entity);
        $this->generateToken($entity);
        $this->sendMail($entity);
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $this->encode($entity);
        $this->generateToken($entity);
        $this->sendMail($entity);
    }

    private function encode($entity)
    {
        // upload only works for User entities
        if (!$entity instanceof User) {
            return;
        }

        if ($entity->getPlainPassword()) {
            $password = $this->encoder->encodePassword($entity, $entity->getPlainPassword());
            $entity->setPassword($password);
        }
    }

    private function generateToken($entity)
    {
        // upload only works for User entities
        if (!$entity instanceof User) {
            return;
        }

        if ($entity->getResetToken() === '1') {
            $entity->setResetToken($this->tokenGenerator->generate());
            return;
        }

        if (!$entity->getIsActive()) {
            $entity->setConfirmationToken($this->tokenGenerator->generate());
        }
    }


    private function sendMail($entity)
    {

        // upload only works for User entities
        if (!$entity instanceof User) {
            return;
        }

        if ($entity->getResetToken()) {
            $message = (new \Swift_Message('Reset password mail'))
                ->setFrom($_ENV['EMAIL_ADDRESS'])
                ->setTo($entity->getEmail())
                ->setBody(
                    $this->twig->render(
                        // templates/email/reset-password.html.twig
                        'email/reset-password.html.twig',
                        array('user' => $entity)
                    ),
                    'text/html'
                )
            ;

            $this->mailer->send($message);
            return;
        }

        if (!$entity->getIsActive()) {
           $message = (new \Swift_Message('Account confirmation mail'))
                ->setFrom($_ENV['EMAIL_ADDRESS'])
                ->setTo($entity->getEmail())
                ->setBody(
                    $this->twig->render(
                        // templates/email/registration.html.twig
                        'email/registration.html.twig',
                        array('user' => $entity)
                    ),
                    'text/html'
                )
            ;
            
            $this->mailer->send($message);
        }
    }

}