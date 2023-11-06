<?php

namespace Project\Application\UseCases;

use Exception;
use Project\Domain\Entities\User\ReadUser;
use Project\Domain\Exceptions\UserNotFoundException;
use Project\Infrastructure\Configuration\Container;
use Project\Infrastructure\Repositories\User\UserDatabaseRepository;
use Project\Infrastructure\Repositories\User\UserRepository;

class GetAllUsers implements UseCase
{
    public string $id;

    public UserRepository $userRepository;


    public function __construct()
    {
        $container            = Container::container();
        $this->userRepository = $container->get(UserRepository::class);
    }

    public function handle(): array
    {
        $users = $this->userRepository->getAll();
        $users = array_map(fn ($user) => new ReadUser($user), $users);

        return $users;
    }
}