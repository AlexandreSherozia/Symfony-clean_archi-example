<?php

namespace App\Domain\User\UseCase\ShowList;

interface ShowListUseCaseInterface
{
	public function execute(ShowListPresenterInterface $showListPresenter);
}