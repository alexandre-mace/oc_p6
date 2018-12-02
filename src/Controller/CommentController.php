<?php

// src/Controller/CommentController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\CommentType; 
use App\Handler\CommentAddHandler;

class CommentController extends AbstractController
{
    /**
     * @Route("/trick/{slug}/add", name="comment_add")
     * @Security("is_granted('ROLE_USER')")     
     */
    public function add(Request $request, Trick $trick, CommentAddHandler $handler)
    {
        $comment = new Comment($trick);
        $form = $this->createForm(CommentType::class, $comment)->handleRequest($request);;
        if ($handler->handle($form, $comment)) {
            return $this->redirectToRoute('trick_show', array('slug' => $trick->getSlug()));
        }
        return $this->render('trick/view.html.twig', [
            'trick' => $trick,
            'form' => $form->createView()
        ]);
	}

}