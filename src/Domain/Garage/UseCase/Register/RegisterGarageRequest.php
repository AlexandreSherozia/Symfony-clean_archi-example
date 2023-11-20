<?php

namespace App\Domain\Garage\UseCase\Register;

class RegisterGarageRequest
{
    public ?string $name;

    public ?string $address;

    public ?string $siren;

    public ?array $violations = null;
}