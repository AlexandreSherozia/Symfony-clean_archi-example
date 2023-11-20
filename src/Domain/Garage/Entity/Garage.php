<?php

namespace App\Domain\Garage\Entity;

class Garage
{
    private string $name;
    private string $siren;
    private string $address;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSiren(): string
    {
        return $this->siren;
    }

    public function setSiren(string $siren): static
    {
        $this->siren = $siren;

        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public static function createGarage(
        string $name,
        string $address,
        string $siren): self
    {
        $garage = new self();
        $garage
            ->setName($name)
            ->setSiren($siren)
            ->setAddress($address);

        return $garage;
    }
}