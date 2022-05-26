<?php

namespace Devboard\Domain\Account;

use Devboard\Database\DAO\UserDAO;
use Error;

class User extends UserDAO
{
    private int $id;
    private string $username;

    protected function getId(): int
    {
        return $this->id;
    }

    protected function getUsername(): string
    {
        return $this->username;
    }

    protected function create(array $account): void
    {
        if (!is_string($account['username'])) {
            throw new Error('Invalid username');
        }
        $this->username = $account['username'];
        $dao = new UserDAO;
        $dao->save($this);
        $this->id = $dao->lastInsertId();
    }

    protected function edit(array $account): void
    {
        if (!is_int($account['id'])) {
            throw new Error('Invalid id');
        }
        $this->id = $account['id'];
        if (!is_string($account['username'])) {
            throw new Error('Invalid username');
        }
        $this->username = $account['username'];
        $dao = new UserDAO;
        $dao->update($this);
    }

    protected function remove(array $account): void
    {
        if (is_int($account['id'])) {
            $this->id = $account['id'];
        }
        $dao = new UserDAO;
        $dao->delete($this);
    }
}
