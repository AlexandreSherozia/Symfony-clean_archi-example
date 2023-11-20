<?php

namespace App\Domain\User\UseCase\Edit;

interface UpdateUserUseCaseInterface
{
	public function execute(UpdateUserRequest $updateUserRequest,UpdateUserPresenterInterface $presenter);
}