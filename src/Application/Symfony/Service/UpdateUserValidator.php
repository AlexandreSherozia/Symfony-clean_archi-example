<?php

namespace App\Infrastructure\Symfony\Service;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class UpdateUserValidator
{
	private Assert\Collection $constraint;
	private ValidatorInterface $validator;

	public function __construct(ValidatorInterface $validator)
	{
		$this->constraint = new Assert\Collection([
			'email'=> new Assert\Required([
				new Assert\Email(),
			]),
			'isPosted'=> new Assert\Optional([
				new Assert\Type('string')
			]),
			'firstName'=> new Assert\Required([
				new Assert\NotBlank()
			]),
			'lastName'=> new Assert\Required([
				new Assert\NotBlank()
			]),
			'save'=> new Assert\Optional(),
		]);

		$this->validator = $validator;
	}

	public function getErrors(?array $updateUserData): ?array
	{
		$violations = $this->validator->validate($updateUserData, $this->constraint);
		if (\count($violations)===0) {
			return null;
		}

		$messages = [];
		foreach ($violations as $violation)
		{
			$messages[] = [
				$violation->getPropertyPath()=>$violation->getMessage(),
			];
		}
		return $messages;
	}
}