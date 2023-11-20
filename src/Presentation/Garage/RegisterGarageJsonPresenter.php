<?php

namespace App\Presentation\Garage;

use App\Domain\Garage\UseCase\Register\RegisterGaragePresenterInterface;
use App\Domain\Garage\UseCase\Register\RegisterGarageResponse;

final class RegisterGarageJsonPresenter implements RegisterGaragePresenterInterface
{
    private RegisterGarageJsonViewModel $viewModel;
    public function present(RegisterGarageResponse $response): void
    {
        $this->viewModel = new RegisterGarageJsonViewModel();
        $this->viewModel->name = $response->getGarage()?->getName();
        $this->viewModel->address = $response->getGarage()?->getAddress();
        $this->viewModel->siren = $response->getGarage()?->getSiren();
        $this->viewModel->violations = $response->getViolations();
    }

    public function viewModel(): RegisterGarageJsonViewModel
    {
        return $this->viewModel;
    }
}