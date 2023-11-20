<?php

namespace App\Domain\User\UseCase\User\Edit;

use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepositoryInterface;

class UpdateUserUseCase implements UpdateUserUseCaseInterface
{

	private UserRepositoryInterface $userRepository;

	public function __construct(UserRepositoryInterface $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	public function execute(UpdateUserRequest $updateUserRequest, UpdateUserPresenterInterface $presenter): void
	{
		$updateUserResponse = new UpdateUserResponse();
		$updateUserResponse->setUser(null);
		$updateUserResponse->setViolations([]);

		if ($updateUserRequest->violations) {
			$updateUserResponse->setViolations($updateUserRequest->violations);
		}

		if ($updateUserRequest->isPosted && null === $updateUserRequest->violations) {
			$user = $this->updateUser($updateUserRequest);
			$updateUserResponse->setUser($user);
		}

		$presenter->present($updateUserResponse);
	}

	private function updateUser(UpdateUserRequest $updateUserRequest)
	{
		$user = User::updateUser(
			$updateUserRequest->id,
			$updateUserRequest->email,
			$updateUserRequest->firstName,
			$updateUserRequest->lastName,
		);

		$this->userRepository->update($user);

		return $user;
	}



}