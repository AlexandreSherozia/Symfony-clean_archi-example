<?php

namespace App\Application\Symfony\Repository;

use App\Domain\User\Entity\User as DomainUser;
use App\Domain\User\Repository\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use App\Application\Symfony\Entity\User;

final class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface, UserRepositoryInterface
{
	private UserPasswordHasherInterface $passwordHasher;
	private EntityManagerInterface $entityManager;
	private RequestStack $request;

	public function __construct(
		ManagerRegistry $registry,
		UserPasswordHasherInterface $passwordHasher,
		EntityManagerInterface $entityManager,RequestStack $request)
	{
		$this->passwordHasher = $passwordHasher;
		$this->entityManager = $entityManager;

		parent::__construct($registry, User::class);
		$this->request = $request;
	}

	public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
	{
		// TODO: Implement upgradePassword() method.
	}

	public function add(DomainUser $domainUser): void
	{
		$user = new User();
		$user->setEmail($domainUser->getEmail());
		$user->setFirstname($domainUser->getFirstName());
		$user->setLastname($domainUser->getLastName());
		$user->setRoles(['ROLE_USER']);

		$hashedPassword = $this->passwordHasher->hashPassword($user,$domainUser->getPassword());
		$user->setPassword($hashedPassword);

		$this->entityManager->persist($user);
		$this->entityManager->flush();
	}



	public function remove(DomainUser $domainUser, bool $flush = false): void
	{
		// TODO: Implement remove() method.
	}

	public function update(DomainUser $domainUser): void
	{
		$user = $this->find($domainUser->getId());

		$user->setEmail($domainUser->getEmail());
		$user->setFirstname($domainUser->getFirstName());
		$user->setLastname($domainUser->getLastName());

//		dd($user);
		$this->entityManager->flush();
	}
}