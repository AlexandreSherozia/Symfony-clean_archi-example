<?php

namespace App\Domain\User\Exception;

class UserAlreadyExistsException extends \Exception
{
	public static function withEmail(string $email): self
	{
		return new self(\sprintf("L'utilisateur avec l'email %s existe déjà", $email));
	}

}