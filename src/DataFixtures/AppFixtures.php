<?php

// src/DataFixtures/AppFixtures.php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Image;
use App\Entity\Trick;
use App\Entity\User;
use App\Entity\Avatar;
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



        $userA = new User;
        $avatarA = new Avatar;
        $avatarA->setName('mute_1.jpg');
        $avatarA->setUser($userA);
        $userA->setUsername('a');
        $userA->setEmail('oc.alexandremace@gmail.com');
        $userA->setAvatar($avatarA);
        $userA->setIsActive(true);
        $userA->setPlainPassword('alexandre');


        $userB = new User;
        $avatarB = new Avatar;
        $avatarB->setName('mute_1.jpg');
        $avatarB->setUser($userB);
        $userB->setUsername('b');
        $userB->setEmail('alex-mace@hotmail.fr');
        $userB->setAvatar($avatarB);
        $userB->setIsActive(true);
        $userB->setPlainPassword('alexandre');
    
        $manager->persist($userB);


        foreach ($data['tricks'] as $trickdata) {
            $trick = new Trick();
            foreach ($trickdata['images'] as $image => $imagedata) {

                $objectImage = new Image();
                $objectImage->setName($imagedata['name']);
                $objectImage->setTrick($trick);
                $objectImage->setAuthor($userA);

                $trick->addImage($objectImage);
            }

            foreach ($trickdata['videos'] as $videodata) {

                $objectVideo = new Video();
                $objectVideo->setUrl($videodata);
                $objectVideo->setTrick($trick);
                $objectVideo->setAuthor($userA);

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

            $trick->setAuthor($userA);
            $trick->setName($trickdata['name']);
            $trick->setDescription($trickdata['description']);
            $trick->setAddedAt(new \datetime());

            $comment = new Comment($trick);
            $comment->setContent('hello, nice trick');
            $comment->setAuthor($userA);

            $manager->persist($comment);
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