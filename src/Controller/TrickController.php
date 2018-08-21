<?php

// src/Controller/TrickController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Entity\Trick;
use App\Entity\Comment;
use App\Entity\Category;
use App\Form\TrickType;
use App\Form\CommentType; 
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class TrickController extends Controller
{
    /**
     * @Route("/", name="trick_index")
     */
    public function index(EntityManagerInterface $manager)
    {
        return $this->render('trick/index.html.twig', [
        	'tricks' => $manager->getRepository(Trick::class)->getTricks(15)
        ]);
    }

    /**
     * @Route("/trick/{slug}", name="trick_show")
     */
    public function show(EntityManagerInterface $manager, Trick $trick)
    {
        $trick = $manager->getRepository(Trick::class)->findBySlug($trick->getSlug());

        if ($trick === null)
        {
            throw new NotFoundHttpException("The trick you are looking for doesnt exist.");
        }  
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
    public function add(Request $request, EntityManagerInterface $manager)
    {
	    $form = $this->createForm(TrickType::class)->handleRequest($request);
	    if ($form->isSubmitted() && $form->isValid()) {
	        $manager->persist($form->getData());
	        $manager->flush();
            $this->addFlash('notice', 'The new trick has been added !');
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
    public function update(Request $request, EntityManagerInterface $manager, Trick $trick)
    {
        $form = $this->createForm(TrickType::class, $trick)->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();
            $this->addFlash('notice', 'The trick has been updated !');
            return $this->redirectToRoute('trick_index');
        }
        return $this->render('trick/edit.html.twig', array(
            'trick' => $trick,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/delete/{slug}", name="trick_delete")
     * @Security("is_granted('ROLE_USER')")          
     */
    public function delete(Request $request, EntityManagerInterface $manager, Trick $trick)
    {
        $this->denyAccessUnlessGranted('delete', $trick);
        $trick->setMainImage(null);
	    $manager->remove($trick);
		$manager->flush();
        $this->addFlash('notice', 'The trick has been successfully deleted !');
	    return $this->redirectToRoute('trick_index');
	}

}