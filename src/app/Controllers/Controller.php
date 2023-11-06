<?php

namespace Project\Application\Controllers;

use Exception;
use Project\Application\UseCases\UseCase;
use Psr\Http\Message\RequestInterface;
use Slim\Routing\RouteContext;

abstract class Controller
{
    public function handle(UseCase $useCase)
    {
        try {
            return $useCase->handle();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function getRouteParams(RequestInterface $request): array
    {
        $arguments = RouteContext::fromRequest($request)->getRoute()->getArguments();

        return $arguments;
    }
}
