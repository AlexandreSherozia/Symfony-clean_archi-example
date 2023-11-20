<?php

namespace App\Application\Symfony\ParamConverter;

use App\Domain\Garage\UseCase\Register\RegisterGarageRequest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class JsonToRegisterGarageRequestConverter implements ParamConverterInterface
{
    public function __construct()
    {
    }

    public function apply(Request $request, ParamConverter $configuration)
    {
        $data = json_decode($request->getContent(), true);


        $registerRequest = new RegisterGarageRequest();

        /* On pourrait mettre un vrai validateur ici */
        /*if (!$garageName) {
            return new JsonResponse(['error' => 'Invalid data'], 400);
        }*/

        $registerRequest->name = $data['name'] ?? null;
        $registerRequest->address = $data['address'] ?? null;
        $registerRequest->siren = $data['siren'] ?? null;

        $request->attributes->set($configuration->getName(),$registerRequest);
//        dd($data, $registerRequest);

        return true;
    }

    public function supports(ParamConverter $configuration)
    {
        return
            'registerGarageRequest' === $configuration->getName() &&
            'JsonToRegisterGarageRequestConverter' === $configuration->getConverter();
    }
}