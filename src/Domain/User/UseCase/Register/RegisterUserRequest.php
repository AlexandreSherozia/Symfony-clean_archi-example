<?php

namespace App\Domain\User\UseCase\User\Register;

class RegisterUserRequest
{
	public ?bool $isPosted = null;

	public ?string $id;

	public ?string $email;

	public ?string $password;

	public ?string $firstName;

	public ?string $lastName;

	public ?array $violations = null;
}