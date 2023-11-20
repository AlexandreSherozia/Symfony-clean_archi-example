<?php

namespace App\Domain\User\Entity;

class User
{
	private string $email;
	private string $password;
	private string $firstName;
	private string $lastName;
	private int $id;

	public function setId(int $id): User
	{
		$this->id = $id;

		return $this;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function setEmail(string $email): self
	{
		$this->email = $email;

		return $this;
	}
	public function getEmail(): string
	{
		return $this->email;
	}

	public function setPassword(string $password): User
	{
		$this->password = $password;

		return $this;
	}
	public function getPassword(): string
	{
		return $this->password;
	}

	public function setFirstName(string $firstName): User
	{
		$this->firstName = $firstName;

		return $this;
	}

	public function getFirstName(): string
	{
		return $this->firstName;
	}

	public function setLastName(string $lastName): User
	{
		$this->lastName = $lastName;

		return $this;
	}
	public function getLastName(): string
	{
		return $this->lastName;
	}

	public static function createUser(
		string $email,
		string $password,
		string $firstName,
		string $lastName
	): self {
		$user = new self();
		$user->setEmail($email);
		$user->setPassword($password);
		$user->setFirstName($firstName);
		$user->setLastName($lastName);

		return $user;
	}

	public static function updateUser(
		int $id,
		string $email,
		string $firstName,
		string $lastName
	): self {
		$user = new self();
		$user
			->setId($id)
			->setEmail($email)
			->setFirstName($firstName)
			->setLastName($lastName);

		return $user;
	}




}