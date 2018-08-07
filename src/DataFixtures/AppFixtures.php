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

        $user = new User;
        $user->setName('a');
        $user->setPassword('aaaaaa');

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
                $objectVideo->setUrl('https://www.youtube.com/watch?v=T1zEBh5HLH8');
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