<?php

namespace Project\Application\Controllers;

use Project\Application\UseCases\SignUp;
use Project\Domain\DTOs\SignUpDto;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class SignUpController
{
    public function __invoke(RequestInterface $request, ResponseInterface $response)
    {
        $requestData = json_decode($request->getBody()->getContents());

        $userDto = new SignUpDto(
            $requestData->name,
            $requestData->type,
            $requestData->email,
            $requestData->document,
            $requestData->car_plate
        );

        $ucResponse = (new SignUp($userDto))->handle();

        $responseKey = gettype($ucResponse) === 'object' ? 'user' : 'error';
        $response->getBody()->write(json_encode([$responseKey => $ucResponse]));

        return $response->withHeader('Content-Type', 'application/json');
    }
}