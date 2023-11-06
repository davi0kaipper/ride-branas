<?php

namespace Project\Application\Controllers;

use Exception;
use Project\Application\UseCases\SignUp;
use Project\Domain\DTOs\SignUpDto;
use Project\Domain\Exceptions\ValidationErrorException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class SignUpController extends Controller
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

        try {
            $ucResponse = (new SignUp($userDto))->handle();
        } catch (ValidationErrorException $e) {
            $ucResponse = (array) json_decode($e->getMessage());
        } catch (Exception $e) {
            $ucResponse = $e->getMessage();
        }

        $responseKey = gettype($ucResponse) === 'object' ? 'user' : 'error';
        $response->getBody()->write(json_encode([$responseKey => $ucResponse]));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
