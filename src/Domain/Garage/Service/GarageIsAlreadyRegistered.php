<?php

namespace App\Domain\Garage\Service;

use App\Domain\Garage\Repository\GarageRepositoryInterface;

readonly final class GarageIsAlreadyRegistered
{

    public function __construct(private GarageRepositoryInterface $garageRepository)
    {
    }

    public function isSatisfiedBy(string $property, $value): bool
    {
        $property = match ($property) {
            'name' => 'name',
            'siren' => 'siren',
            default => 'cette propriété est inexistante',
        };
        $garage = $this->garageRepository->findOneBy([
            $property=>$value,
        ]);

        return $garage !== null;
    }
}