<?php

// src/Controller/TrickController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Entity\Trick;
use App\Form\TrickType;
use App\Form\CommentType; 
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Handler\TrickAddHandler;
use App\Handler\TrickUpdateHandler;
use App\Handler\TrickDeleteHandler;

class TrickController extends AbstractController
{
    /**
     * @Route("/", name="trick_index")
     */
    public function index(EntityManagerInterface $manager)
    {
        return $this->render('trick/index.html.twig', [
        	'tricks' => $manager->getRepository(Trick::class)->getTricks()
        ]);
    }

    /**
     * @Route("/trick/{slug}", name="trick_show")
     */
    public function show(Trick $trick)
    {
        $form = $this->createForm(CommentType::class);
        return $this->render('trick/view.html.twig', [
            'trick' => $trick,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/add", name="trick_add")
     * @Security("is_granted('ROLE_USER')")     
     */
    public function add(Request $request, TrickAddHandler $handler)
    {
	    $form = $this->createForm(TrickType::class)->handleRequest($request);
	    if ($handler->handle($form)) {
	        return $this->redirectToRoute('trick_index');
	    }
	    return $this->render('trick/add.html.twig', array(
	        'form' => $form->createView(),
	    ));
	}

    /**
     * @Route("/update/{slug}", name="trick_update")
     * @Security("is_granted('ROLE_USER')")     
     */
    public function update(Request $request, Trick $trick, TrickUpdateHandler $handler)
    {
        $form = $this->createForm(TrickType::class, $trick)->handleRequest($request);
        if ($handler->handle($form)) {
            return $this->redirectToRoute('trick_index');
        }
        return $this->render('trick/edit.html.twig', array(
            'trick' => $trick,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/delete/{slug}", name="trick_delete")
     */
    public function delete(Trick $trick, TrickDeleteHandler $handler)
    {
        $handler->handle($trick);
	    return $this->redirectToRoute('trick_index');
	}

}