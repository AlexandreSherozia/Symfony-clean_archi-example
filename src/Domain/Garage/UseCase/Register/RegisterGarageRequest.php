<?php

namespace App\Domain\Garage\UseCase\Register;

class RegisterGarageRequest
{
    public ?array $violations = null;

    public function __construct(
        public readonly ?string $name,
        public readonly ?string $address,
        public readonly ?string $siren)
    {
    }
}