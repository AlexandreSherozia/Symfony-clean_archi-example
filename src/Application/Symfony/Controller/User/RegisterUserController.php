<?php

namespace App\Application\Symfony\Controller\User;

use App\Application\Symfony\View\RegisterHtmlView;
use App\Domain\User\UseCase\Register\RegisterUserRequest;
use App\Domain\User\UseCase\Register\RegisterUserUseCaseInterface;
use App\Presentation\User\RegisterUserHtmlPresenter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/register-via-html-form', name: 'app_register_user')]
/**
 * @ParamConverter(name="registerUserRequest", converter="FormToRegisterRequestConverter")
 */
class RegisterUserController extends AbstractController
{
	public function __construct(
		private readonly RegisterHtmlView  $registerHtmlView,
		private readonly RegisterUserUseCaseInterface $registerUseCase,
		private readonly RegisterUserHtmlPresenter $presenter)
	{}


    public function __invoke(RegisterUserRequest $registerUserRequest): Response
    {
	    $this->registerUseCase->execute($registerUserRequest, $this->presenter);

	    return $this->registerHtmlView->generateView(
			$registerUserRequest,
			$this->presenter->viewModel()
		);
    }
}
