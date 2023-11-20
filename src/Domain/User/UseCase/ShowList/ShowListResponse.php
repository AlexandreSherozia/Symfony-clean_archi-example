<?php

namespace App\Domain\User\UseCase\ShowList;

class ShowListResponse
{
	private array $users;

	public function getUsers(): array
	{
		return $this->users;
	}

	public function setUsers(array $users): self
	{
		$this->users=$users;

		return $this;
	}
}