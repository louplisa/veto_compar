<?php


namespace App\Entity;


class DispenseSearch
{
private $price;

private $pet;

private $medical_treatment;

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     * @return DispenseSearch
     */
    public function setPrice($price)
    {
        $this->price = $price;
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
     * @return DispenseSearch
     */
    public function setPet($pet)
    {
        $this->pet = $pet;
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
     * @return DispenseSearch
     */
    public function setMedicalTreatment($medical_treatment)
    {
        $this->medical_treatment = $medical_treatment;
        return $this;
    }


}
