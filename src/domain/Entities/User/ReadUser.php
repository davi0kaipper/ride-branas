<?php

namespace Project\Domain\Entities\User;

class ReadUser
{
    public string $id;

    public string $type;

    public string $name;

    public string $email;

    public string $cpf;

    public string|null $car_plate;


    public function __construct(User $user)
    {
        $this->id        = $user->id;
        $this->type      = $user->type->value;
        $this->name      = $user->name;
        $this->email     = $user->email->getValue();
        $this->cpf       = $user->cpf->getValue();
        $this->car_plate = $user->car_plate->getValue();
    }
}