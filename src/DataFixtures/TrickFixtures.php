<?php

// src/DataFixtures/AppFixtures.php

namespace App\DataFixtures;

use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TrickFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 tricks! Bam!
        $data => [
            'tricks' => [
                'mute' => [
                    'name' => 'mute',
                    'description' => 'saisie de la carre frontside de la planche entre les deux pieds avec la main avant'

                ],
                'indy' => [
                    'name' => 'indy',
                    'description' => 'saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière'
                ],
                'tail grab' => [
                    'name' => 'tail grab',
                    'description' => 'saisie de la partie arrière de la planche, avec la main arrière'
                ],
                'nose grab' => [
                    'name' => 'nose grab',
                    'description' => 'saisie de la partie avant de la planche, avec la main avant'
                ],

                '360' => [
                    'name' => '360',
                    'description' => 'trois six pour un tour complet'
                ],
                '1080' => [
                    'name' => '1080',
                    'description' => 'ou big foot pour trois tours'
                ]


            ]

        ]
        for ($i = 0; $i < 20; $i++) {
            $trick = new Trick();
            $trick->setName([$a[$i]]);
            $trick->setPrice(mt_rand(10, 100));
            $manager->persist($trick);
        }

        $manager->flush();
    }
}