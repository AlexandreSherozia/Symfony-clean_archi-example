<?php

namespace App\Domain\User\UseCase\User\Register;

interface RegisterUserUseCaseInterface
{
	public function execute(RegisterUserRequest $registerRequest, RegisterUserPresenterInterface $presenter): void;
}