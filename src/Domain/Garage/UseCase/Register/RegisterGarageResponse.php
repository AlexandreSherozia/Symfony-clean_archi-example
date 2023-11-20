<?php

namespace App\Domain\Garage\UseCase\Register;

use App\Domain\Garage\Entity\Garage;

class RegisterGarageResponse
{
    private ?array $violations;
    private ?Garage $garage;

    public function getViolations(): ?array
    {
        return $this->violations;
    }

    public function setViolations(?array $violations): void
    {
        $this->violations = $violations;
    }

    public function getGarage(): ?Garage
    {
        return $this->garage;
    }

    public function setGarage(?Garage $garage): void
    {
        $this->garage = $garage;
    }
}