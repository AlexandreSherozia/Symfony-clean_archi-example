<?php

namespace App\Domain\Garage\UseCase\Register;

interface RegisterGarageUseCaseInterface
{
    public function execute(RegisterGarageRequest $request, RegisterGaragePresenterInterface $presenter);
}