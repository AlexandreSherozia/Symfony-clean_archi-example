<?php

namespace App\Domain\User\UseCase\User\ShowList;

use App\Domain\User\Repository\UserRepositoryInterface;

class ShowListUseCase implements ShowListUseCaseInterface
{
	private UserRepositoryInterface $userRepository;

	public function __construct(UserRepositoryInterface $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	public function execute(ShowListPresenterInterface $showListPresenter): void
	{
		$showListResponse = new ShowListResponse();

		$users = $this->getUsers();

		$showListResponse->setUsers($users);

		$showListPresenter->present($showListResponse);
	}

	public function getUsers(): array
	{
		return $this->userRepository->findAll();
	}
}