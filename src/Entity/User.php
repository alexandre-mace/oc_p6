<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $passsword;

    /**
     * @ORM\Column(type="datetime")
     */
    private $addedAt;

    public function getId()
    {
        return $this->id;
    }

    public function getPasssword(): ?string
    {
        return $this->passsword;
    }

    public function setPasssword(string $passsword): self
    {
        $this->passsword = $passsword;

        return $this;
    }

    public function getAddedAt(): ?\DateTimeInterface
    {
        return $this->addedAt;
    }

    public function setAddedAt(\DateTimeInterface $addedAt): self
    {
        $this->addedAt = $addedAt;

        return $this;
    }
}
