<?php

namespace App\Domain\User\UseCase\User\Edit;

class UpdateUserRequest
{
	public ?int $id;

	public ?bool $isPosted = null;

	public ?string $email;

	public ?string $firstName;

	public ?string $lastName;

	public ?array $violations = null;
}