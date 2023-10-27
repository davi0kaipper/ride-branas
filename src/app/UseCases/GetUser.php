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
use Project\Infrastructure\Repositories\User\UserDatabaseRepository;
use Project\Infrastructure\Repositories\User\UserRepository;

class GetUser
{
    public string $id;
    public UserRepository $userRepository;
    public function __construct(string $id)
    {
        $this->id = $id;
        $this->userRepository = new UserDatabaseRepository();
    }

    public function handle(): ReadUser|string
    {
        try {
            $user = $this->userRepository->getById($this->id);
            $user = new ReadUser($user);
        } catch (UserNotFoundException $e) {
            return $e->getMessage();
        }

        return $user;
    }
}