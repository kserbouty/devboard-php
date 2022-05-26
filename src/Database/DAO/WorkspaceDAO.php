<?php

namespace Devboard\Database\DAO;

use PDO;
use PDOException;
use Devboard\Domain\Dashboard\Workspace;

class WorkspaceDAO extends DAO
{
    protected function __construct()
    {
        parent::connexion();
    }

    protected function findAll(): iterable
    {
        try {
            $statement = $this->pdo->prepare("SELECT * FROM `workspace`");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_CLASS, Workspace::class);
        } catch (PDOException $e) {
            $message = "Cannot find workspaces: " . $e->getMessage();
            $code = $e->getCode();
            throw new PDOException($message, $code);
        }
    }

    protected function save(Workspace $workspace): void
    {
        try {
            $name = $workspace->getName();
            $user_id = $workspace->getUserId();
            $statement = $this->pdo->prepare("INSERT INTO `workspace` (`name`, `user_id`) VALUES ((?), (?))");
            $statement->bindValue(1, $name, PDO::PARAM_STR);
            $statement->bindValue(2, $user_id, PDO::PARAM_INT);
            $statement->execute();
        } catch (PDOException $e) {
            $message = "Workspace creation failed: " . $e->getMessage();
            $code = $e->getCode();
            throw new PDOException($message, $code);
        }
    }

    protected function update(Workspace $workspace): void
    {
        try {
            $name = $workspace->getName();
            $id = $workspace->getId();
            $user_id = $workspace->getUserId();
            $statement = $this->pdo->prepare("UPDATE `workspace` SET `name`=(?) WHERE `workspace`.`id`=(?) AND `workspace`.`user_id`=(?)");
            $statement->bindValue(1, $name, PDO::PARAM_STR);
            $statement->bindValue(2, $id, PDO::PARAM_INT);
            $statement->bindValue(3, $user_id, PDO::PARAM_INT);
            $statement->execute();
        } catch (PDOException $e) {
            $message = "Workspace update failed: " . $e->getMessage();
            $code = $e->getCode();
            throw new PDOException($message, $code);
        }
    }
}
