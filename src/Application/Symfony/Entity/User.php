<?php

namespace App\Infrastructure\Symfony\Entity;

use App\Infrastructure\Symfony\Repository\UserRepository;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column]
	private ?int $id = null;

	#[ORM\Column(type: "json")]
	private array $roles;

	#[ORM\Column(type: "string")]
	private string $password;

	#[ORM\Column(type: "string", length: 100)]
	private string $email;

	#[ORM\Column(type: "string", length: 255)]
	private string $firstname;
	#[ORM\Column(type: "string", length: 255)]
	private string $lastname;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getEmail(): string
	{
		return $this->email;
	}

	public function setEmail(string $email): void
	{
		$this->email = $email;
	}

	public function getPassword(): ?string
	{
		return $this->password;
	}

	public function setPassword(string $password): self
	{
		$this->password = $password;

		return $this;
	}

	public function getFirstname(): ?string
	{
		return $this->firstname;
	}

	public function setFirstname(string $firstname): self
	{
		$this->firstname = $firstname;

		return $this;
	}

	public function getLastname(): ?string
	{
		return $this->lastname;
	}

	public function setLastname(string $lastname): self
	{
		$this->lastname = $lastname;

		return $this;
	}

	public function getRoles(): array
	{
		$roles = $this->roles;

		$roles[] = 'ROLE_USER';

		return array_unique($roles);
	}

	public function setRoles($roles): self
	{
		$this->roles = $roles;

		return $this;
	}

	public function eraseCredentials()
	{
		// TODO: Implement eraseCredentials() method.
	}

	public function getUserIdentifier(): string
	{
		// TODO: Implement getUserIdentifier() method.
	}
}