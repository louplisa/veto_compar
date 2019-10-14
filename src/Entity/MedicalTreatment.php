<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MedicalTreatmentRepository")
 */
class MedicalTreatment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Dispense", mappedBy="medical_treatment", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $dispenses;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

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
     * @return MedicalTreatment
     */
    public function setDispenses($dispenses)
    {
        $this->dispenses = $dispenses;
        return $this;
    }


}
