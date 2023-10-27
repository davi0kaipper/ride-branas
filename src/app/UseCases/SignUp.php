<?php

namespace Project\Application\UseCases;

use Exception;
use Project\Domain\DTOs\SignUpDto;
use Project\Domain\Entities\User\User;
use Project\Domain\Entities\User\ReadUser;
use Project\Domain\Enums\User\UserType;
use Project\Domain\Exceptions\InvalidDocumentException;
use Project\Domain\Exceptions\InvalidEmailException;
use Project\Domain\Exceptions\InvalidCarPlateException;
use Project\Infrastructure\Repositories\User\UserDatabaseRepository;
use Project\Infrastructure\Repositories\User\UserRepository;
use Project\Application\Validation\SignUpValidator;

class SignUp
{
    public SignUpDto $dto;
    public UserRepository $userRepository;
    public function __construct(SignUpDto $dto)
    {
        $this->dto = $dto;
        $this->userRepository = new UserDatabaseRepository();
    }

    public function handle(): ReadUser|string
    {
        try {
            $this->validateDto($this->dto);
            $this->userRepository->create($this->dto->toArray());
            $user = $this->userRepository->getByDocument($this->dto->document);
            $user = new ReadUser($user);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return $user;
    }

    private function validateDto(SignUpDto $dto): void
    {
        $payloadValidation = SignUpValidator::validate($dto);
        UserType::from($this->dto->type);
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