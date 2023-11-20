<?php

namespace App\Domain\User\UseCase\ShowList;

interface ShowListPresenterInterface
{
	public function present(ShowListResponse $showListResponse);
}