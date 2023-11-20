<?php

namespace App\Presentation\User;

use App\Domain\User\UseCase\ShowList\ShowListPresenterInterface;
use App\Domain\User\UseCase\ShowList\ShowListResponse;

class ShowListHtmlPresenter implements ShowListPresenterInterface
{
	private ShowListViewModel $viewModel;

	public function present(ShowListResponse $showListResponse): void
	{
		$this->viewModel = new ShowListViewModel();
		$this->viewModel->users = $showListResponse->getUsers();
	}

	public function viewModel(): ShowListViewModel
	{
		return $this->viewModel;
	}
}