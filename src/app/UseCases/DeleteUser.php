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

class DeleteUser
{
    public string $id;
    public UserRepository $userRepository;
    public function __construct(string $id)
    {
        $this->id = $id;
        $this->userRepository = new UserDatabaseRepository();
    }

    public function handle(): int|string
    {
        try {
            $rowsAffected = $this->userRepository->delete($this->id);

            if ($rowsAffected === 0) {
                throw new UserNotFoundException;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return 'User deleted successfully.';
    }

    private function validateDto(SignUpDto $dto): void
    {
        UserType::tryFrom($this->dto->type);
        $documentAlreadyUsed = $this->userRepository->checkIfAlreadyExists('document', $this->dto->document);
        $emailAlreadyUsed = $this->userRepository->checkIfAlreadyExists('email', $this->dto->email);

        if ($documentAlreadyUsed) {
            throw new InvalidDocumentException;
        }

        if ($emailAlreadyUsed) {
            throw new InvalidEmailException;
        }

        if ($this->dto->carPlate != null) {
            $carPlateAlreadyUsed = $this->userRepository->checkIfAlreadyExists('car_plate', $this->dto->carPlate);

            if ($carPlateAlreadyUsed) {
                throw new InvalidCarPlateException;
            }
        }
    }

    private function createUser(SignUpDto $dto): User
    {
        // var_dump($dto); die;
        $this->userRepository->create($this->dto->toArray());

        return $this->userRepository->getByDocument($this->dto->document);
    }
}