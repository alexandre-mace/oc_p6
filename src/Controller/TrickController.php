<?php

// src/Controller/TrickController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Trick;

class TrickController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {

        $repository = $this->getDoctrine()->getRepository(Trick::class);

        $tricks = $repository->getTricks(10);

        return $this->render('trick/index.html.twig', ['tricks' => $tricks]);

    }
}