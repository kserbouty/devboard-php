<?php

namespace Devboard\Database\DAO;

use PDO;
use PDOException;
use Devboard\Domain\Account\User;

class UserDAO extends DAO
{
    protected function __construct()
    {
        parent::connexion();
    }

    public function findAll(): iterable
    {
        try {
            $statement = $this->pdo->prepare("SELECT * FROM `user`");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_CLASS, User::class);
        } catch (PDOException $e) {
            $message = "Cannot find accounts: " . $e->getMessage();
            $code = $e->getCode();
            throw new PDOException($message, $code);
        }
    }

    public function findById(int $id): User
    {
        try {
            $statement = $this->pdo->prepare("SELECT * FROM `user` WHERE `id`=" . $id);
            $statement->execute();
            return $statement->fetchObject(User::class);
        } catch (PDOException $e) {
            $message = "Cannot find account: " . $e->getMessage();
            $code = $e->getCode();
            throw new PDOException($message, $code);
        }
    }

    public function save(User $user): void
    {
        try {
            $username = $user->getUsername();
            $statement = $this->pdo->prepare("INSERT INTO `user` (`username`) VALUES (?)");
            $statement->bindValue(1, $username, PDO::PARAM_STR);
            $statement->execute();
        } catch (PDOException $e) {
            $message = "Registration failed: " . $e->getMessage();
            $code = $e->getCode();
            throw new PDOException($message, $code);
        }
    }

    public function update(User $user): void
    {
        try {
            $id = $user->getId();
            $username = $user->getUsername();
            $statement = $this->pdo->prepare("UPDATE `user` SET `username`=(?) WHERE `user`.`id`=(?)");
            $statement->bindValue(1, $username, PDO::PARAM_STR);
            $statement->bindValue(2, $id, PDO::PARAM_INT);
            $statement->execute();
        } catch (PDOException $e) {
            $message = "Update failed: " . $e->getMessage();
            $code = $e->getCode();
            throw new PDOException($message, $code);
        }
    }

    public function delete(User $user): void
    {
        try {
            $id = $user->getId();
            $statement = $this->pdo->prepare("DELETE FROM `user` WHERE `user`.`id`=(?)");
            $statement->bindValue(1, $id, PDO::PARAM_INT);
            $statement->execute();
        } catch (PDOException $e) {
            $message = "Cannot delete account: " . $e->getMessage();
            $code = $e->getCode();
            throw new PDOException($message, $code);
        }
    }

    public function lastInsertId(): int
    {
        return $this->pdo->lastInsertId();
    }
}
