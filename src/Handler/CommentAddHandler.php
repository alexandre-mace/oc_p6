<?php

namespace App\Handler;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use App\Entity\Comment;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;


class CommentAddHandler
{
    private $manager;
    private $flashBag;

    public function __construct(EntityManagerInterface $manager, FlashBagInterface $flashBag)
    {
        $this->manager = $manager;
        $this->flashBag = $flashBag;
    }

    public function handle(FormInterface $form, Comment $comment)
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($comment);
            $this->manager->flush();
            $this->flashBag->add('success', 'The new comment has been successfully added !');
            return true;
        }

        return false;
    }
}