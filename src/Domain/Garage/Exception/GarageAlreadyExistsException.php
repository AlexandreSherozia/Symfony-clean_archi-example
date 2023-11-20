<?php

namespace App\Domain\Garage\Exception;

class GarageAlreadyExistsException extends \Exception
{
    public static function withSiren(string $siren)
    {
        return new self(\sprintf("Le garage avec le siren %s existe déjà", $siren));
    }

    public static function withName(string $name)
    {
        return new self(\sprintf("Le garage avec le nom %s existe déjà", $name));
    }
}