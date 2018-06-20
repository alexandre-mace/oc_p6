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

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categories = ['grabs', 'rotations', 'flips', 'slides', 'old school', 'one foot'];

        $tricks = [
            'mute' => [
                'name' => 'mute',
                'description' => 'saisie de la carre frontside de la planche entre les deux pieds avec la main avant',
                'categories' => 'grabs',
                'images' => [
                    'mute_1' => [
                        'url' => 'images/mute_1.jpg',
                        'alt' => ''
                    ],
                    'mute_1' => [
                        'url' => 'images/mute_2.jpg',
                        'alt' => ''
                    ],
                    'mute_1' => [
                        'url' => 'images/mute_3.jpg',
                        'alt' => ''
                    ]                    
                ],
                'videos' => [
                    '1' => [
                        'width' => '1280',
                        'height' => '720',
                        'controls' => TRUE,
                        'src' => 'videos/1.mp4',
                        'type' => 'mp4',
                        'autoplay' => FALSE
                    ]
                ]
            ],
            'indy' => [
                'name' => 'indy',
                'description' => 'saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière',
                'categories' => 'grabs',
                'images' => [
                    'indy_1' => [
                        'url' => 'images/indy_1.jpg',
                        'alt' => ''
                    ],
                    'indy_1' => [
                        'url' => 'images/indy_2.jpg',
                        'alt' => ''
                    ],
                    'indy_1' => [
                        'url' => 'images/indy_3.jpg',
                        'alt' => ''
                    ]                    
                ],
                'videos' => [
                    '1' => [
                        'width' => '1280',
                        'height' => '720',
                        'controls' => TRUE,
                        'src' => 'videos/1.mp4',
                        'type' => 'mp4',
                        'autoplay' => FALSE
                    ]
                ]              

            ],
            'tail grab' => [
                'name' => 'tail grab',
                'description' => 'saisie de la partie arrière de la planche, avec la main arrière',
                'categories' => 'grabs',
                'images' => [
                    'tail_grab_1' => [
                        'url' => 'images/tail_grab_1.jpg',
                        'alt' => ''
                    ],
                    'tail_grab_1' => [
                        'url' => 'images/tail_grab_2.jpg',
                        'alt' => ''
                    ],
                    'tail_grab_1' => [
                        'url' => 'images/tail_grab_3.jpg',
                        'alt' => ''
                    ]                    
                ],
                'videos' => [
                    '1' => [
                        'width' => '1280',
                        'height' => '720',
                        'controls' => TRUE,
                        'src' => 'videos/1.mp4',
                        'type' => 'mp4',
                        'autoplay' => FALSE
                    ]
                ]              
            ],
            'nose grab' => [
                'name' => 'nose grab',
                'description' => 'saisie de la partie avant de la planche, avec la main avant',
                'categories' => 'grabs',
                'images' => [
                    'nose_grab_1' => [
                        'url' => 'images/nose_grab_1.jpg',
                        'alt' => ''
                    ],
                    'nose_grab_1' => [
                        'url' => 'images/nose_grab_2.jpg',
                        'alt' => ''
                    ],
                    'nose_grab_1' => [
                        'url' => 'images/nose_grab_3.jpg',
                        'alt' => ''
                    ]                    
                ],
                'videos' => [
                    '1' => [
                        'width' => '1280',
                        'height' => '720',
                        'controls' => TRUE,
                        'src' => 'videos/1.mp4',
                        'type' => 'mp4',
                        'autoplay' => FALSE
                    ]
                ]                
            ],
            '360' => [
                'name' => '360',
                'description' => 'Tour complet sur soi-même',
                'categories' => 'rotations',
                'images' => [
                    '360_1' => [
                        'url' => 'images/360_1.jpg',
                        'alt' => ''
                    ],
                    '360_1' => [
                        'url' => 'images/360_2.jpg',
                        'alt' => ''
                    ],
                    '360_1' => [
                        'url' => 'images/360_3.jpg',
                        'alt' => ''
                    ]                    
                ],
                'videos' => [
                    '1' => [
                        'width' => '1280',
                        'height' => '720',
                        'controls' => TRUE,
                        'src' => 'videos/1.mp4',
                        'type' => 'mp4',
                        'autoplay' => FALSE
                    ]
                ]                
            ],
            'big foot' => [
                'name' => 'big foot',
                'description' => '(ou 1080) Trois tours complets sur soi-même',
                'categories' => 'rotations',
                'images' => [
                    'big_foot_1' => [
                        'url' => 'images/big_foot_1.jpg',
                        'alt' => ''
                    ],
                    'big_foot_1' => [
                        'url' => 'images/big_foot_2.jpg',
                        'alt' => ''
                    ],
                    'big_foot_1' => [
                        'url' => 'images/big_foot_3.jpg',
                        'alt' => ''
                    ]                    
                ],
                'videos' => [
                    '1' => [
                        'width' => '1280',
                        'height' => '720',
                        'controls' => TRUE,
                        'src' => 'videos/1.mp4',
                        'type' => 'mp4',
                        'autoplay' => FALSE
                    ]
                ]                
            ],
            'nose slide' => [
                'name' => 'nose slide',
                'description' => 'Glisser sur une barre de slide avec l\'avant de la planche en contact avec la barre',
                'categories' => 'slides',
                'images' => [
                    'nose_slide_1' => [
                        'url' => 'images/nose_slide_1.jpg',
                        'alt' => ''
                    ],
                    'nose_slide_1' => [
                        'url' => 'images/nose_slide_2.jpg',
                        'alt' => ''
                    ],
                    'nose_slide_1' => [
                        'url' => 'images/nose_slide_3.jpg',
                        'alt' => ''
                    ]                    
                ],
                'videos' => [
                    '1' => [
                        'width' => '1280',
                        'height' => '720',
                        'controls' => TRUE,
                        'src' => 'videos/1.mp4',
                        'type' => 'mp4',
                        'autoplay' => FALSE
                    ]
                ]                
            ],
            'tail slide' => [
                'name' => 'tail slide',
                'description' => 'Glisser sur une barre de slide avec l\'arrière de la planche en contact avec la barre',
                'categories' => 'slides',
                'images' => [
                    'tail_slide_1' => [
                        'url' => 'images/tail_slide_1.jpg',
                        'alt' => ''
                    ],
                    'tail_slide_1' => [
                        'url' => 'images/tail_slide_2.jpg',
                        'alt' => ''
                    ],
                    'tail_slide_1' => [
                        'url' => 'images/tail_slide_3.jpg',
                        'alt' => ''
                    ]                    
                ],
                'videos' => [
                    '1' => [
                        'width' => '1280',
                        'height' => '720',
                        'controls' => TRUE,
                        'src' => 'videos/1.mp4',
                        'type' => 'mp4',
                        'autoplay' => FALSE
                    ]
                ]                
            ],
            'frontflip' => [
                'name' => 'frontflip',
                'description' => 'Rotation en avant. Il est possible de faire plusieurs flips à la suite, et d\'ajouter un grab à la rotation.',
                'categories' => 'flips',
                'images' => [
                    'frontflip_1' => [
                        'url' => 'images/frontflip_1.jpg',
                        'alt' => ''
                    ],
                    'frontflip_1' => [
                        'url' => 'images/frontflip_2.jpg',
                        'alt' => ''
                    ],
                    'frontflip_1' => [
                        'url' => 'images/frontflip_3.jpg',
                        'alt' => ''
                    ]                    
                ],
                'videos' => [
                    '1' => [
                        'width' => '1280',
                        'height' => '720',
                        'controls' => TRUE,
                        'src' => 'videos/1.mp4',
                        'type' => 'mp4',
                        'autoplay' => FALSE
                    ]
                ]                
            ],
            'backflip' => [
                'name' => 'backflip',
                'description' => 'Rotation en arrière. Il est possible de faire plusieurs flips à la suite, et d\'ajouter un grab à la rotation.',
                'categories' => 'flips',
                'images' => [
                    'backflip_1' => [
                        'url' => 'images/backflip_1.jpg',
                        'alt' => ''
                    ],
                    'backflip_1' => [
                        'url' => 'images/backflip_2.jpg',
                        'alt' => ''
                    ],
                    'backflip_1' => [
                        'url' => 'images/backflip_3.jpg',
                        'alt' => ''
                    ]                    
                ],
                'videos' => [
                    '1' => [
                        'width' => '1280',
                        'height' => '720',
                        'controls' => TRUE,
                        'src' => 'videos/1.mp4',
                        'type' => 'mp4',
                        'autoplay' => FALSE
                    ]
                ]                
            ],

        ];

        foreach ($tricks as $trick => $data) {
            $trick = new Trick();
            foreach ($trick['images'] as $image => $data) {
                $image['alt'] = 'Photo de la figure ' . $trick['name'] . ' de snowboard.';

                $objectImage = new Image();
                $objectImage->setUrl($image['url']);
                $objectImage->setAlt($image['alt']);
                $objectImage->setTrick($trick);

                $trick->addImage($objectImage);
            }
            foreach ($trick['videos'] as $video => $data) {

                $objectVideo = new Video();
                $objectVideo->setWidth($video['width']);
                $objectVideo->setHeight($video['height']);
                $objectVideo->setControls($video['controls']);
                $objectVideo->setSrc($video['src']);
                $objectVideo->setType($video['type']);
                $objectVideo->setAutoplay($video['autoplay']);
                $objectVideo->setTrick($trick);

                $trick->addVideo($objectVideo);
            }
            
            foreach ($trick['categories'] as $category) {

                $objectCategory = new Category();
                $objectCategory->setName($category);

                $trick->addCategory($objectCategory);

            }
            $trick->setName($trick['name']);
            $trick->setDescription($trick['description']);

            $manager->persist($trick);
        }

        $manager->flush();
    }
}