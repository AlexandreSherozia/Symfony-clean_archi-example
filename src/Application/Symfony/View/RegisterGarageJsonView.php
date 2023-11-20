<?php

namespace App\Application\Symfony\View;

use App\Domain\Garage\UseCase\Register\RegisterGarageRequest;
use App\Presentation\Garage\RegisterGarageJsonViewModel;
use Symfony\Component\HttpFoundation\JsonResponse;

final class RegisterGarageJsonView
{
    public function generateView(
        RegisterGarageJsonViewModel $viewModel
    ): JsonResponse {
        if ($viewModel->violations) {
            return new JsonResponse($viewModel->violations, 400);
        }

        return new JsonResponse(
            [
                'name' => $viewModel->name,
                'address' => $viewModel->address,
                'siren' => $viewModel->siren,
                'message' => 'Garage a été créé avec succès'
            ], 201
        );
    }
}