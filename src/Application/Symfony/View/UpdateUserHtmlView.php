<?php

namespace App\Infrastructure\Symfony\View;

use App\Domain\User\UseCase\Edit\UpdateUserRequest;
use App\Domain\User\UseCase\Register\RegisterUserRequest;
use App\Infrastructure\Symfony\Form\RegisterUserType;
use App\Infrastructure\Symfony\Form\UpdateUserType;
use App\Presentation\User\RegisterUserHtmlViewModel;
use App\Presentation\User\UpdateUserHtmlViewModel;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class UpdateUserHtmlView
{

	private Environment $twig;
	private FormFactoryInterface $formFactory;

	public function __construct(Environment $twig, FormFactoryInterface $formFactory)
	{
		$this->twig = $twig;
		$this->formFactory = $formFactory;
	}

	public function generateView(
		UpdateUserRequest $updateUserRequest,
		UpdateUserHtmlViewModel $viewModel
	): Response
	{
		if (!$viewModel->violations && $updateUserRequest->isPosted) {
			return new Response($this->twig->render(
				'user/register_complete.html.twig',
				[
					'viewModel'=>$viewModel
				]
			));
		}

		$form = $this->formFactory->createBuilder(UpdateUserType::class, $updateUserRequest)->getForm();

		return new Response($this->twig->render(
			'user/updateUser.html.twig',
			[
				'form' => $form->createView(),
				'viewModel' => $viewModel
			]
		));
	}
}