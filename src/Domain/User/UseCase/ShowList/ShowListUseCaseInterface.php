<?php

namespace App\Domain\User\UseCase\User\ShowList;

interface ShowListUseCaseInterface
{
	public function execute(ShowListPresenterInterface $showListPresenter);
}