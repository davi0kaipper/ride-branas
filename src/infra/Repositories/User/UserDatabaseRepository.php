<?php

namespace Project\Infrastructure\Repositories\User;

use Carbon\Carbon;
use Exception;
use PDO;
use Project\Domain\Entities\User\User;
use Project\Domain\Enums\User\UserType;
use Project\Domain\Exceptions\UserNotFoundException;
use Project\Infrastructure\Connections\MySQLDatabaseConnection;
use Ramsey\Uuid\Uuid;
use Project\Domain\ValueObjects\Email;
use Project\Domain\ValueObjects\Cpf;
use Project\Domain\ValueObjects\CarPlate;
use Project\Infrastructure\Repositories\User\UserRepository;

class UserDatabaseRepository implements UserRepository
{
    public function __construct(public MySQLDatabaseConnection $conn)
    {
        //
    }

    public function getById(string $id): User
    {
        $statement = $this->conn->connection()->prepare('SELECT * FROM users WHERE id = :id', [PDO::ATTR_CURSOR, PDO::CURSOR_FWDONLY]);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (! $user) {
            throw new UserNotFoundException();
        }

        return $this->user($user);
    }

    public function getByDocument(string $document): User
    {
        $statement = $this->conn->connection()->prepare('SELECT * FROM users WHERE document = :document', [PDO::ATTR_CURSOR, PDO::CURSOR_FWDONLY]);
        $statement->bindParam(':document', $document);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $this->user($user);
    }

    public function getAll(): array
    {
        $statement = $this->conn->connection()->prepare('SELECT * FROM users');
        $statement->execute();
        $allUsers = $statement->fetchAll(PDO::FETCH_ASSOC);
        $allUsers = array_map(fn ($user) => $this->user($user), $allUsers);
        return $allUsers;
    }

    public function create(array $values): void
    {
        $values['type']       = UserType::tryFrom($values['type'])->backingValueForDatabase();
        $values['id']         = Uuid::uuid1()->toString();
        $values['created_at'] = Carbon::now()->format('Y-m-d H:i:s');

        $columns      = 'id, type, name, document, email, car_plate, created_at';
        $placeholders = ':id, :type, :name, :document, :email, :car_plate, :created_at';

        $this->conn->connection()->prepare("INSERT INTO users ($columns) VALUES ($placeholders)")->execute($values);
    }

    public function update(string $id, array $values): void
    {
        $columnsSettling = [];

        foreach ($values as $key => $value) {
            $columnsSettling[] = "$key = :$key";
        }

        $columnsSettling = implode(', ', $columnsSettling);
        $statement       = "UPDATE users SET $columnsSettling WHERE id = :id";

        $values['id'] = $id;

        $statement = $this->conn->connection()->prepare($statement);
        $statement->bindParam(':id', $id);
        $statement->execute($values);
    }

    public function delete(string $id): int
    {
        $statement = $this->conn->connection()->prepare('DELETE FROM users WHERE id = :id');
        $statement->execute(['id' => $id]);
        $affectedRows = $statement->rowCount();

        return $affectedRows;
    }

    public function checkIfAlreadyExists(string $column, string $value): bool
    {
        $statement = $this->conn->connection()->prepare("SELECT COUNT(*) FROM users WHERE $column = :value", [PDO::ATTR_CURSOR, PDO::CURSOR_FWDONLY]);
        $statement->execute([':value' => $value]);
        $exists = $statement->fetch(PDO::FETCH_ASSOC)['COUNT(*)'];

        return $exists > 0;
    }

    public function user(array $user): User
    {
        return new User(
            $user['id'],
            UserType::tryFrom($user['type']),
            $user['name'],
            new Email($user['email']),
            new Cpf($user['document']),
            new CarPlate($user['car_plate']),
        );
    }
}