<?php

namespace App\Application\Symfony\ParamConverter;

use App\Application\Symfony\Service\UserRegisterValidator;
use App\Domain\User\UseCase\Register\RegisterUserRequest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Uid;

class FormToRegisterRequestConverter implements ParamConverterInterface
{
	private UserRegisterValidator $validator;

	public function __construct(UserRegisterValidator $validator)
	{
		$this->validator = $validator;
	}

	public function apply(Request $request, ParamConverter $configuration)
	{
		$registerUserData = $request->request->all();
		$registerRequest = new RegisterUserRequest();
		$isPosted = $registerUserData['register_user']['isPosted']??null;
		if ($isPosted) {
			$registerRequest->violations = $this->validator->getErrors($registerUserData['register_user'] ?? null);
			$registerRequest->isPosted=(bool)(int) $isPosted;
			$registerRequest->email=$registerUserData['register_user']['email']??null;
			$registerRequest->firstName=$registerUserData['register_user']['firstName']??null;
			$registerRequest->lastName=$registerUserData['register_user']['lastName']??null;
			$registerRequest->password=$registerUserData['register_user']['password']??null;
		}

		$request->attributes->set($configuration->getName(),$registerRequest);

		return true;
	}

	public function supports(ParamConverter $configuration)
	{
		return
			'registerUserRequest' === $configuration->getName() &&
			'FormToRegisterRequestConverter'=== $configuration->getConverter()
			;

	}
}