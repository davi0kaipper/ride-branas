<?php

namespace Project\Application\Controllers\User;

use Project\Application\UseCases\SignUp;
use Project\Application\Controllers\Controller;
use Project\Application\UseCases\DeleteUser;
use Project\Application\UseCases\GetUser;
use Project\Domain\DTOs\SignUpDto;
use Project\Domain\Entities\User\ReadUser;
use Project\Domain\Exceptions\UserNotFoundException;
use Project\Infrastructure\Repositories\User\UserDatabaseRepository;
use Project\Infrastructure\Repositories\User\UserRepository;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Routing\RouteContext;

class UserController extends Controller
{
    public UserRepository $userRepository;

    public function __construct(
        // public UserRepository $userRepository
    )
    {
        $this->userRepository = new UserDatabaseRepository();
    }

    public function get(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $id = $this->getRouteParams($request)['user_id'];
        $ucResponse = (new GetUser($id))->handle();
        $responseKey = gettype($ucResponse) === 'object' ? 'user' : 'error';
        $response->getBody()->write(json_encode([$responseKey => $ucResponse]));

        return $response->withHeader('Content-Type', 'application/json');
    }

    public function delete(RequestInterface $request, ResponseInterface $response)
    {
        $id = $this->getRouteParams($request)['user_id'];
        // var_dump($id);
        $ucResponse = (new DeleteUser($id))->handle();
        $responseKey = $ucResponse === 'User deleted successfully.' ? 'success' : 'error';
        $response->getBody()->write(json_encode([$responseKey => $ucResponse]));

        return $response->withHeader('Content-Type', 'application/json');
    }
}