<?php

namespace Project\Application\Validation;

use Project\Domain\DTOs\SignUpDto;
use Project\Domain\Enums\User\UserType;
use Respect\Validation\Validator as v;

class SignUpValidator extends Validator
{
    public array $fields;

    public array $rules;


    public function __construct(SignUpDto $signupDto)
    {
        $this->fields = $this->fields($signupDto);
        $this->rules  = $this->rules();
    }

    public function rules(): array
    {
        $nameValidationRules     = v::alpha('-')->length(3, 50);
        $typeValidationRules     = v::in(UserType::backingValues());
        $emailValidationRules    = v::email();
        $documentValidationRules = v::cpf();
        $carPlateValidationRules = v::regex('/[A-Z]{3}[0-9][0-9A-Z][0-9]{2}/');

        return [
            'name'      => $nameValidationRules,
            'type'      => $typeValidationRules,
            'email'     => $emailValidationRules,
            'document'  => $documentValidationRules,
            'car_plate' => $carPlateValidationRules,
        ];
    }

    public function fields(SignUpDto $signupDto): array
    {
        return [
            'name'      => $signupDto->name,
            'type'      => $signupDto->type,
            'email'     => $signupDto->email,
            'document'  => $signupDto->document,
            'car_plate' => $signupDto->car_plate,
        ];
    }
}