<?php

namespace Project\Application\Controllers;

use Psr\Http\Message\RequestInterface;
use Slim\Routing\RouteContext;

abstract class Controller
{
    public function getRouteParams(RequestInterface $request): array
    {
        $arguments = RouteContext::fromRequest($request)
            ->getRoute()
            ->getArguments();

        return $arguments;
    }
}