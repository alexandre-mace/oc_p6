<?php

// src/Controller/FileController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class FileController extends AbstractController {

    /**
     * @Route("/file/upload")
     */
    public function upload(Request $request)
    {
        $file = $request->files->get("file");
        $fileName = md5(uniqid()).'.'.$file->guessExtension();
        $file->move($this->getParameter('images_directory'), $fileName);
        return $this->json($fileName);
    }

}