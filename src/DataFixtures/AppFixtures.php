<?php

// src/DataFixtures/AppFixtures.php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Image;
use App\Entity\Trick;
use App\Entity\User;
use App\Entity\Video;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $data = Yaml::parseFile('src/DataFixtures/AppFixtures.yaml');

        $singletonCategories = [];

        foreach ($data['tricks'] as $trickarray => $trickdata) {
            $trick = new Trick();
            foreach ($trickdata['images'] as $image => $imagedata) {
                $imagedata['alt'] = 'Photo de la figure ' . $trickdata['name'] . ' de snowboard.';

                $objectImage = new Image();
                $objectImage->setSrc($imagedata['src']);
                $objectImage->setAlt($imagedata['alt']);
                $objectImage->setTrick($trick);

                $trick->addImage($objectImage);
            }

            foreach ($trickdata['videos'] as $videoarray => $videodata) {

                $objectVideo = new Video();
                $objectVideo->setWidth($videodata['width']);
                $objectVideo->setHeight($videodata['height']);
                $objectVideo->setControls($videodata['controls']);
                $objectVideo->setSrc($videodata['src']);
                $objectVideo->setType($videodata['type']);
                $objectVideo->setAutoplay($videodata['autoplay']);
                $objectVideo->setTrick($trick);

                $trick->addVideo($objectVideo);
            }
            
            foreach ($trickdata['categories'] as $category) {
                if (!isset($singletonCategories[$category])) {
                    $singletonCategories[$category] = $category; 
                    $objectCategory = new Category();
                    $objectCategory->setName($category);

                }
                $trick->addCategory($objectCategory);
            }

            $trick->setName($trickdata['name']);
            $trick->setDescription($trickdata['description']);
            $trick->setAddedAt(new \datetime());

            $manager->persist($trick);

        }

        foreach ($data['categories'] as $category) {
            if (!isset($singletonCategories[$category])) {
                $objectCategory = new Category();
                $objectCategory->setName($category);
                $singletonCategories[$category] = $objectCategory; 
                $manager->persist($objectCategory);
            }
        }

        $manager->flush();
    }
}