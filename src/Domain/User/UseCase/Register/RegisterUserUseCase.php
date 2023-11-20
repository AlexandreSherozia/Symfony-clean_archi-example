<?php

namespace App\Domain\User\UseCase\User\Register;

use App\Domain\User\Entity\User;
use App\Domain\User\Exception\UserAlreadyExistsException;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\Service\UserIsAlreadyRegistered;

class RegisterUserUseCase implements RegisterUserUseCaseInterface
{

	private UserRepositoryInterface $userRepository;
	private UserIsAlreadyRegistered $userIsAlreadyRegistered;

	public function __construct(
		UserRepositoryInterface $userRepository,
		UserIsAlreadyRegistered $userIsAlreadyRegistered)
	{
		$this->userRepository = $userRepository;
		$this->userIsAlreadyRegistered = $userIsAlreadyRegistered;
	}

	public function execute(RegisterUserRequest $registerRequest, RegisterUserPresenterInterface $presenter): void
	{
		$registerUserResponse = new RegisterUserResponse();
		$registerUserResponse->setUser(null);
		$registerUserResponse->setViolations([]);

		if ($registerRequest->violations) {
			$registerUserResponse->setViolations($registerRequest->violations);
		}

		if ($registerRequest->isPosted && null === $registerRequest->violations) {
			try
			{
				$user = $this->saveUser($registerRequest);
				$registerUserResponse->setUser($user);
			} catch (UserAlreadyExistsException $exception) {
				$registerUserResponse->setViolations(['email'=>$exception->getMessage()]);
			}
		}
		$presenter->present($registerUserResponse);
	}

	/**
	 * @throws UserAlreadyExistsException
	 */
	private function saveUser(RegisterUserRequest $registerRequest): User
	{
		if ($this->userIsAlreadyRegistered->isSatisfiedBy($registerRequest->email)) {
			throw UserAlreadyExistsException::withEmail($registerRequest->email);
		}

		$user = User::createUser(
			$registerRequest->email,
			$registerRequest->password,
			$registerRequest->firstName,
			$registerRequest->lastName
		);

		$this->userRepository->add($user);

		return $user;
	}
}