<?php

namespace App\Domain\User\UseCase\Edit;

interface UpdateUserPresenterInterface
{
	public function present(UpdateUserResponse $updateUserResponse);
}