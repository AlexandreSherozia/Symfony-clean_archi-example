<?php

namespace App\Domain\Garage\UseCase\Register;

use App\Domain\Garage\Entity\Garage;
use App\Domain\Garage\Exception\GarageAlreadyExistsException;
use App\Domain\Garage\Repository\GarageRepositoryInterface;
use App\Domain\Garage\Service\GarageIsAlreadyRegistered;

readonly class RegisterGarageUseCase implements RegisterGarageUseCaseInterface
{
    public function __construct(
        private GarageRepositoryInterface $garageRepository,
        private GarageIsAlreadyRegistered $garageIsAlreadyRegistered
    )
    {
    }

    public function execute(RegisterGarageRequest $request, RegisterGaragePresenterInterface $presenter)
    {
        $garageResponse = new RegisterGarageResponse();
        $garageResponse->setGarage(garage: null);
        $garageResponse->setViolations([]);

        if ($request->violations) {
            $garageResponse->setViolations($request->violations);
        }

        if (null === $request->violations) {
            try {
                $garage = $this->saveGarage($request);
                $garageResponse->setGarage($garage);
            } catch (GarageAlreadyExistsException $e) {
                $garageResponse->setViolations([
                    'message'=>$e->getMessage()
                ]);
            }
        }
        $presenter->present($garageResponse);
    }

    /* Je lui passe le DTO */
    /**
     * @throws GarageAlreadyExistsException
     */
    private function saveGarage(RegisterGarageRequest $registerGarageRequest)
    {
//        dd($registerGarageRequest);
        if ($this->garageIsAlreadyRegistered->isSatisfiedBy('name',$registerGarageRequest->name)) {
            throw GarageAlreadyExistsException::withName($registerGarageRequest->name);
        }

        if ($this->garageIsAlreadyRegistered->isSatisfiedBy('siren',$registerGarageRequest->siren)) {
            throw GarageAlreadyExistsException::withSiren($registerGarageRequest->siren);
        }

        $domainGarage = Garage::createGarage(
            $registerGarageRequest->name,
            $registerGarageRequest->address,
            $registerGarageRequest->siren
        );

        $this->garageRepository->add($domainGarage);

        return $domainGarage;
    }
}