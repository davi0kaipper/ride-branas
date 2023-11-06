<?php

namespace Project\Application\Controllers;

use Project\Application\UseCases\SignUp;
use Project\Application\Controllers\Controller;
use Project\Application\UseCases\DeleteUser;
use Project\Application\UseCases\GetAllUsers;
use Project\Application\UseCases\GetUser;
use Project\Domain\DTOs\SignUpDto;
use Project\Domain\Entities\User\ReadUser;
use Project\Domain\Exceptions\UserNotFoundException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Routing\RouteContext;

class UserController extends Controller
{
    public function get(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $id          = $this->getRouteParams($request)['user_id'];
        $ucResponse  = $this->handle(new GetUser($id));
        $responseKey = gettype($ucResponse) === 'object' ? 'user' : 'error';
        $response->getBody()->write(json_encode([$responseKey => $ucResponse]));

        return $response->withHeader('Content-Type', 'application/json');
    }


    public function getAll(ResponseInterface $response): ResponseInterface
    {
        $ucResponse  = $this->handle(new GetAllUsers());
        $responseKey = gettype($ucResponse) === 'array' ? 'users' : 'error';
        $response->getBody()->write(json_encode([$responseKey => $ucResponse]));

        return $response->withHeader('Content-Type', 'application/json');
    }


    public function delete(RequestInterface $request, ResponseInterface $response)
    {
        $id = $this->getRouteParams($request)['user_id'];

        $ucResponse  = ($this->handle(new DeleteUser($id)) ?? 'User deleted successfully.');
        $responseKey = $ucResponse === 'User deleted successfully.' ? 'success' : 'error';
        $response->getBody()->write(json_encode([$responseKey => $ucResponse]));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
