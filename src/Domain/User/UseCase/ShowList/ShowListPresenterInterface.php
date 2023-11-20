<?php

namespace App\Domain\User\UseCase\User\ShowList;

interface ShowListPresenterInterface
{
	public function present(ShowListResponse $showListResponse);
}