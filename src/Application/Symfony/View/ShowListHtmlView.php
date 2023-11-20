<?php

namespace App\Infrastructure\Symfony\View;

use App\Presentation\User\ShowListViewModel;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class ShowListHtmlView
{

	private Environment $twig;

	public function __construct(Environment $twig)
	{
		$this->twig = $twig;
	}

	public function generateView(ShowListViewModel $viewModel): Response
	{
		return new Response($this->twig->render(
			'user/show_users_list.html.twig', [
				'viewModel'=>$viewModel
			]
		));
	}
}