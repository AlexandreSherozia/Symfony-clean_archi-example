<?php

namespace App\Domain\User\UseCase\User\Register;

interface RegisterUserPresenterInterface
{
	public function present(RegisterUserResponse $registerUserResponse);
}