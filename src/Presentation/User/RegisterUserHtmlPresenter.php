<?php

namespace App\Presentation\User;

use App\Domain\User\UseCase\Register\RegisterUserPresenterInterface;
use App\Domain\User\UseCase\Register\RegisterUserResponse;

class RegisterUserHtmlPresenter implements RegisterUserPresenterInterface
{
	private RegisterUserHtmlViewModel $viewModel;
	public function present(RegisterUserResponse $registerUserResponse): void
	{
		$this->viewModel = new RegisterUserHtmlViewModel();
		$this->viewModel->email = $registerUserResponse->getUser()?->getEmail();
		$this->viewModel->violations = $registerUserResponse->getViolations();
	}

	public function viewModel(): RegisterUserHtmlViewModel
	{
		return $this->viewModel;
	}
}