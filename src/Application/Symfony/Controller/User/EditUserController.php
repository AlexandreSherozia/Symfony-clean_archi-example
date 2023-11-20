<?php

namespace App\Application\Symfony\Controller\User;

use App\Application\Symfony\View\UpdateUserHtmlView;
use App\Domain\User\UseCase\Edit\UpdateUserRequest;
use App\Domain\User\UseCase\Edit\UpdateUserUseCaseInterface;
use App\Presentation\User\UpdateUserHtmlPresenter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/edit-user/{userId}', name: "app_edit_user")]
/**
 * @ParamConverter(name="updateUserRequest", converter="FormToUpdateUserRequestConverter")
 */
class EditUserController extends AbstractController
{
	private UpdateUserUseCaseInterface $updateUserUseCase;
	private UpdateUserHtmlPresenter $presenter;
	private UpdateUserHtmlView $updateUserHtmlView;

	public function __construct(
		UpdateUserHtmlView $updateUserHtmlView,
		UpdateUserUseCaseInterface $updateUserUseCase,
		UpdateUserHtmlPresenter $presenter)
	{
		$this->updateUserHtmlView = $updateUserHtmlView;
		$this->updateUserUseCase = $updateUserUseCase;
		$this->presenter = $presenter;
	}

	public function __invoke(UpdateUserRequest $updateUserRequest): Response
	{
		$this->updateUserUseCase->execute($updateUserRequest, $this->presenter);

		return $this->updateUserHtmlView->generateView(
			$updateUserRequest,
			$this->presenter->viewModel()
		);
	}
}