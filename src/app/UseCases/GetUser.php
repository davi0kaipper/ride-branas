<?php

namespace Project\Application\UseCases;

use Exception;
use Project\Domain\DTOs\SignUpDto;
use Project\Domain\Entities\User\ReadUser;
use Project\Domain\Entities\User\User;
use Project\Domain\Enums\User\UserType;
use Project\Domain\Exceptions\InvalidDocumentException;
use Project\Domain\Exceptions\InvalidEmailException;
use Project\Domain\Exceptions\InvalidCarPlateException;
use Project\Domain\Exceptions\UserNotFoundException;
use Project\Infrastructure\Configuration\Container;
use Project\Infrastructure\Repositories\User\UserDatabaseRepository;
use Project\Infrastructure\Repositories\User\UserRepository;

class GetUser implements UseCase
{
    public string $id;

    public UserRepository $userRepository;


    public function __construct(string $id)
    {
        $this->id             = $id;
        $container            = Container::container();
        $this->userRepository = $container->get(UserRepository::class);
    }

    public function handle(): ReadUser|string
    {
        $user = $this->userRepository->getById($this->id);
        $user = new ReadUser($user);

        return $user;
    }
}