<?php

namespace App\Domain\Garage\UseCase\Register;

interface RegisterGaragePresenterInterface
{
    public function present(RegisterGarageResponse $response);
}