<?php

namespace App\Application\Symfony\Controller\User;

use App\Application\Symfony\View\ShowListHtmlView;
use App\Domain\User\UseCase\ShowList\ShowListPresenterInterface;
use App\Domain\User\UseCase\ShowList\ShowListUseCaseInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/list-all-users', name: "app_show_all_users")]
class UserListController extends AbstractController
{
	private ShowListUseCaseInterface $showListUseCase;
	private ShowListPresenterInterface $showListPresenter;
	private ShowListHtmlView $showListHtmlView;

	public function __construct(
		ShowListHtmlView $showListHtmlView,
		ShowListUseCaseInterface $showListUseCase,
		ShowListPresenterInterface $showListPresenter)
	{
		$this->showListUseCase = $showListUseCase;
		$this->showListPresenter = $showListPresenter;
		$this->showListHtmlView = $showListHtmlView;
	}

	public function __invoke()
	{
		$this->showListUseCase->execute($this->showListPresenter);

		return $this->showListHtmlView->generateView(
			$this->showListPresenter->viewModel()
		);
	}
}