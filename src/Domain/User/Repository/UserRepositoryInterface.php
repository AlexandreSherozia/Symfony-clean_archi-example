<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Entity\User;

interface UserRepositoryInterface
{
	public function add(User $domainUser): void;

	public function update(User $domainUser): void;

	public function remove(User $domainUser, bool $flush = false): void;

	public function findOneBy(array $criteria);

	public function findAll();
}