<?php

namespace Project\Application\Validation;

use Project\Domain\DTOs\SignUpDto;
use Project\Domain\Enums\User\UserType;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

abstract class Validator
{
    public array $fields;

    public array $rules;

    public array $errors = [];


    public function validate(): array
    {
        foreach ($this->rules as $fieldName => $rule) {
            $fieldLabel = str_replace('_', ' ', $fieldName);

            try {
                $rule->setName($fieldLabel)->assert($this->fields[$fieldName]);
            } catch (NestedValidationException $e) {
                $this->errors[$fieldName] = $e->getMessages();
            }
        }

        return $this->errors;
    }
}