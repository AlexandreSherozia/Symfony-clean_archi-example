<?php

namespace App\Infrastructure\Symfony\ParamConverter;

use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\UseCase\Edit\UpdateUserRequest;
use App\Infrastructure\Symfony\Service\UpdateUserValidator;
use App\Infrastructure\Symfony\Service\UserRegisterValidator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

class FormToUpdateUserRequestConverter implements ParamConverterInterface
{

	private UpdateUserValidator $validator;
	private UserRepositoryInterface $userRepository;

	public function __construct(UpdateUserValidator $validator,UserRepositoryInterface $userRepository)
	{
		$this->validator = $validator;
		$this->userRepository = $userRepository;
	}

	public function apply(Request $request, ParamConverter $configuration)
	{
		$updateUserData = $request->request->all();
		$userId = $request->get('userId');
		$user = $this->userRepository->find($userId);
		$updateUserRequest = new UpdateUserRequest();
		$updateUserRequest->email = $user->getEmail();
		$updateUserRequest->firstName = $user->getFirstName();
		$updateUserRequest->lastName = $user->getLastName();
//		dd($updateUserRequest);
		$isPosted = $updateUserData['update_user']['isPosted']??null;
		if ($isPosted) {
//			dd($updateUserData,$request->get('userId'),$user);
			$updateUserRequest->violations = $this->validator->getErrors($updateUserData['update_user'] ?? null);
			$updateUserRequest->isPosted=(bool)(int) $isPosted;
			$updateUserRequest->email=$updateUserData['update_user']['email']??null;
			$updateUserRequest->firstName=$updateUserData['update_user']['firstName']??null;
			$updateUserRequest->lastName=$updateUserData['update_user']['lastName']??null;
			$updateUserRequest->id=$userId;
		}

		$request->attributes->set($configuration->getName(),$updateUserRequest);

		return true;
	}

	public function supports(ParamConverter $configuration)
	{
		return
			'updateUserRequest' ===$configuration->getName() &&
			'FormToUpdateUserRequestConverter'===$configuration->getConverter()
			;
	}
}