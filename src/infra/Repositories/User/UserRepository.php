<?php

namespace Project\Infrastructure\Repositories\User;

use Project\Domain\Entities\Driver;
use Project\Domain\Entities\Passenger;
use Project\Domain\Entities\User\User;

interface UserRepository
{
    public function getByDocument(string $document): User;
    public function getAll(): array;
    public function create(array $values): void;
    public function update(string $id, array $columns): void;
    public function delete(string $id): int;
    public function checkIfAlreadyExists(string $column, string $value): bool;
}