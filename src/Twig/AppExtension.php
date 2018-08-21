<?php

namespace App\Twig;

// src/Twig/AppExtension.php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use App\Entity\Trick;
use App\Entity\Image;

class AppExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return array(
            new \Twig_Function('getTrickMainImage', array($this, 'getTrickMainImage')),
        );
    }

    public function getTrickMainImage(Trick $trick)
    {
        if ($trick->getMainImage()) {
            return 'uploads/images/' . $trick->getMainImage()->getName();
        } 
        elseif ($trick->getImages()) {
            return 'uploads/images/' . array_shift(array_slice($trick->getImages(), 0, 1))->getName();
        }
        return ('../../images/' . Image::DEFAULT_PICTURE);
    }
}