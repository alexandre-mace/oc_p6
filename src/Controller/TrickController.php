<?php

// src/Controller/TrickController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Trick;
use App\Entity\Category;
use App\Form\TrickType;
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

        return $this->render('trick/trick.html.twig', [
            'trick' => $trick
        ]);
    }

    /**
     * @Route("/add", name="trick_add")
     */
    public function add(Request $request, EntityManagerInterface $manager)
    {
	    $form = $this->createForm(TrickType::class)->handleRequest($request);
	    if ($form->isSubmitted() && $form->isValid()) {
	        $manager->persist($form->getData());
	        $manager->flush();
	        return $this->redirectToRoute('trick_index');
	    }
	    return $this->render('trick/edit.html.twig', array(
	        'form' => $form->createView(),
	    ));
	}

    /**
     * @Route("/update/{slug}", name="trick_update")
     */
    public function update(Request $request, EntityManagerInterface $manager, Trick $trick)
    {
	    $form = $this->createForm(TrickType::class, $trick)->handleRequest($request);
	    if ($form->isSubmitted() && $form->isValid()) {
	        $manager->flush();
	        return $this->redirectToRoute('trick_index');
	    }
	    return $this->render('trick/edit.html.twig', array(
	        'form' => $form->createView(),
	    ));
	}

    /**
     * @Route("/delete/{slug}", name="trick_delete")
     */
    public function delete(Request $request, EntityManagerInterface $manager, Trick $trick)
    {
        $trick->setMainImage(null);
	    $manager->remove($trick);
		$manager->flush();
	    return $this->redirectToRoute('trick_index');
	}

}