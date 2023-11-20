<?php

namespace App\Domain\Garage\Repository;

use App\Domain\Garage\Entity\Garage;

interface GarageRepositoryInterface
{
    public function add(Garage $garage): void;

    public function update(Garage $garage): void;

    public function remove(Garage $garage, bool $flush = false): void;

    public function findOneBy(array $criteria);

}