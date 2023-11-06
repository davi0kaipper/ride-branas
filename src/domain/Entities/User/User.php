<?php

namespace Project\Domain\Entities\User;

use Cassandra\Uuid;
use Project\Domain\Enums\User\UserType;
use Project\Domain\ValueObjects\CarPlate;
use Project\Domain\ValueObjects\Cpf;
use Project\Domain\ValueObjects\Email;

class User
{
    public function __construct(
        public string $id,
        public UserType $type,
        public string $name,
        public Email $email,
        public Cpf $cpf,
        public CarPlate $car_plate
    ){
        //
    }
}