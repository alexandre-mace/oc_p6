<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
<<<<<<< HEAD
use Symfony\Component\Validator\Constraints as Assert;
=======
>>>>>>> 6499792091b6081ccd910e0866c1fd0d2de82a80

/**
 * @ORM\Entity(repositoryClass="App\Repository\VideoRepository")
 */
class Video
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Trick", inversedBy="videos")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid
     */
    private $trick;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url()
     */
    private $url;

    public function getId()
    {
        return $this->id;
    }

    public function getTrick(): ?Trick
    {
        return $this->trick;
    }

    public function setTrick(?Trick $trick): self
    {
        $this->trick = $trick;


        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
