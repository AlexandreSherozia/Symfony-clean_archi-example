<?php

namespace App\Application\Symfony\Controller\Api\Garage;

use App\Application\Symfony\View\RegisterGarageJsonView;
use App\Domain\Garage\UseCase\Register\RegisterGarageRequest;
use App\Domain\Garage\UseCase\Register\RegisterGarageUseCaseInterface;
use App\Presentation\Garage\RegisterGarageJsonPresenter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class ApiGarageCreationController extends AbstractController
{
    public function __construct(
        private readonly RegisterGarageJsonView $registerGarageJsonView,
        private readonly RegisterGarageUseCaseInterface $registerUseCase,
        private readonly RegisterGarageJsonPresenter $jsonPresenter,
    )
    {
    }

    #[Route('/api/garage', name: 'app_api_create_garage', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload] RegisterGarageRequest $registerGarageRequest): Response
    {
        $this->registerUseCase->execute($registerGarageRequest, $this->jsonPresenter);

        return $this->registerGarageJsonView->generateView(
            $this->jsonPresenter->viewModel(),
        );
    }
}
