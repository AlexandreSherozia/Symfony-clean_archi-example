<?php

namespace App\Domain\User\UseCase\User\Edit;

interface UpdateUserPresenterInterface
{
	public function present(UpdateUserResponse $updateUserResponse);
}