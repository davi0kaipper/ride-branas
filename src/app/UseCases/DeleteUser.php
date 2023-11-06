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

class DeleteUser implements UseCase
{
    public string $id;

    public UserRepository $userRepository;


    public function __construct(string $id)
    {
        $container = Container::container();

        $this->id             = $id;
        $this->userRepository = $container->get(UserRepository::class);
    }

    public function handle(): void
    {
        $rowsAffected = $this->userRepository->delete($this->id);

        if ($rowsAffected === 0) {
            throw new UserNotFoundException();
        }
    }
}