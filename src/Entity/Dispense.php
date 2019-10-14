<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DispenseRepository")
 */
class Dispense
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
    private $price;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $quality;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MedicalTreatment", inversedBy="dispenses", cascade={"persist"})
     * @ORM\JoinColumn(name="medical_treatment_id", referencedColumnName="id")
     */
    private $medical_treatment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pet", inversedBy="dispenses")
     * @ORM\JoinColumn(name="pet_id", referencedColumnName="id")
     */
    private $pet;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\VeterinaryClinic", inversedBy="dispenses", cascade={"persist"})
     * @ORM\JoinColumn(name="veterinary_clinic_id", referencedColumnName="id")
     */
    private $veterinary_clinic;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getQuality(): ?string
    {
        return $this->quality;
    }

    public function setQuality(?string $quality): self
    {
        $this->quality = $quality;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMedicalTreatment()
    {
        return $this->medical_treatment;
    }

    /**
     * @param mixed $medical_treatment
     * @return Dispense
     */
    public function setMedicalTreatment($medical_treatment)
    {
        $this->medical_treatment = $medical_treatment;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPet()
    {
        return $this->pet;
    }

    /**
     * @param mixed $pet
     * @return Dispense
     */
    public function setPet($pet)
    {
        $this->pet = $pet;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVeterinaryClinic()
    {
        return $this->veterinary_clinic;
    }

    /**
     * @param mixed $veterinary_clinic
     * @return Dispense
     */
    public function setVeterinaryClinic($veterinary_clinic)
    {
        $this->veterinary_clinic = $veterinary_clinic;
        return $this;
    }
}
