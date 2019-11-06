<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PetRepository")
 */
class Pet
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
    private $espece;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $build;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $sex;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Dispense", mappedBy="pet", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $dispenses;


    public function __construct()
    {
        $this->dispenses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEspece(): ?string
    {
        return $this->espece;
    }

    public function setEspece(string $espece): self
    {
        $this->espece = $espece;

        return $this;
    }

    public function getBuild(): ?string
    {
        return $this->build;
    }

    public function setBuild(?string $build): self
    {
        $this->build = $build;

        return $this;
    }

    public function getSex(): ?bool
    {
        return $this->sex;
    }

    public function setSex(?bool $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDispenses()
    {
        return $this->dispenses;
    }

    /**
     * @param mixed $dispenses
     * @return Pet
     */
    public function setDispenses($dispenses)
    {
        $this->dispenses = $dispenses;
        return $this;
    }

    public function addDispense(Dispense $dispense): self
    {
        if (!$this->dispenses->contains($dispense)) {
            $this->dispenses[] = $dispense;
            $dispense->setPet($this);
        }

        return $this;
    }
}
