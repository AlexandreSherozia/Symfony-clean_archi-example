<?php

namespace App\Domain\User\UseCase\User\Edit;

interface UpdateUserUseCaseInterface
{
	public function execute(UpdateUserRequest $updateUserRequest,UpdateUserPresenterInterface $presenter);
}