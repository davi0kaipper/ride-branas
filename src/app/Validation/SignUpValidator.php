<?php

namespace Project\Application\Validation;

use Project\Domain\DTOs\SignUpDto;
use Project\Domain\Enums\User\UserType;
use Respect\Validation\Validator as v;

class SignUpValidator
{
    public static function validate(SignUpDto $dto)
    {
        $nameValidator = v::alpha('-')->length(3, 50);
        // $typeValidator = v::in(UserType::cases());
        // $emailValidator = v::alpha('-')->length(3, 50);
        // $documentValidator = v::alpha('-')->length(3, 50);
        // $carPlateValidator = v::alpha('-')->length(3, 50);

        // $nameValidator->validate($dto->name);
        // $typeValidator->validate($dto->name);
        // $emailValidator->validate($dto->name);
        // $documentValidator->validate($dto->name);
        // $carPlateValidator->validate($dto->name);
        return 1;
    }
}