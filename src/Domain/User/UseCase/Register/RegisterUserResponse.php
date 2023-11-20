<?php

namespace App\Domain\User\UseCase\User\Register;

use App\Domain\User\Entity\User;

class RegisterUserResponse
{
	private ?array $violations;
	private ?User $user;

	public function getViolations(): ?array
	{
		return $this->violations;
	}

	public function setViolations(?array $violations): void
	{
		$this->violations = $violations;
	}

	public function getUser(): ?User
	{
		return $this->user;
	}

	public function setUser(?User $user): void
	{
		$this->user = $user;
	}
}