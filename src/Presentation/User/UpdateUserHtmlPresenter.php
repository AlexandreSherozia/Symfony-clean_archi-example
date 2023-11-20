<?php

namespace App\Presentation\User;

use App\Domain\User\UseCase\Edit\UpdateUserPresenterInterface;
use App\Domain\User\UseCase\Edit\UpdateUserResponse;

class UpdateUserHtmlPresenter implements UpdateUserPresenterInterface
{

	private UpdateUserHtmlViewModel $viewModel;
	public function present(UpdateUserResponse $updateUserResponse): void
	{
		$this->viewModel = new UpdateUserHtmlViewModel();
		$this->viewModel->email = $updateUserResponse->getUser()?->getEmail();
		$this->viewModel->violations = $updateUserResponse->getViolations();
	}

	public function viewModel(): UpdateUserHtmlViewModel
	{
		return $this->viewModel;
	}
}