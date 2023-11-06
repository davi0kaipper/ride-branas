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
use Project\Application\Validation\Validator;
use Project\Domain\Exceptions\ValidationErrorException;

class SignUp implements UseCase
{
    public SignUpDto $dto;

    public UserRepository $userRepository;

    public Validator $validator;


    public function __construct(SignUpDto $dto)
    {
        $this->dto            = $dto;
        $this->userRepository = new UserDatabaseRepository();
        $this->validator      = new SignUpValidator($dto);
    }

    public function handle(): ReadUser
    {
        $this->validateDto();
        $this->userRepository->create($this->dto->toArray());
        $user = $this->userRepository->getByDocument($this->dto->document);
        $user = new ReadUser($user);

        return $user;
    }

    private function validateDto(): void
    {
        $payloadValidation = $this->validator->validate();

        if ($payloadValidation !== []) {
            throw new ValidationErrorException($payloadValidation);
        }

        UserType::from($this->dto->type);
        $documentAlreadyUsed = $this->userRepository->checkIfAlreadyExists('document', $this->dto->document);
        $emailAlreadyUsed    = $this->userRepository->checkIfAlreadyExists('email', $this->dto->email);

        if ($documentAlreadyUsed) {
            throw new InvalidDocumentException();
        }

        if ($emailAlreadyUsed) {
            throw new InvalidEmailException();
        }

        if ($this->dto->car_plate != null) {
            $carPlateAlreadyUsed = $this->userRepository->checkIfAlreadyExists('car_plate', $this->dto->car_plate);

            if ($carPlateAlreadyUsed) {
                throw new InvalidCarPlateException();
            }
        }
    }
}