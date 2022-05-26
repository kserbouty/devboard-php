<?php

namespace Devboard\Domain\Dashboard;

use Devboard\Database\DAO\WorkspaceDAO;
use Error;

class Workspace extends WorkspaceDAO
{
    private int $id;
    private string $name;
    private int $user_id;

    protected function getId(): int
    {
        return $this->id;
    }

    protected function getName(): string
    {
        return $this->name;
    }

    protected function getUserId(): int
    {
        return $this->user_id;
    }

    protected function create(array $workspace)
    {
        if (!is_string($workspace['name'])) {
            throw new Error('Invalid workspace name');
        }
        $this->name = $workspace['name'];
        if (!is_int($workspace['user_id'])) {
            throw new Error('Invalid user id');
        }
        $this->user_id = $workspace['user_id'];
        $dao = new WorkspaceDAO;
        $dao->save($this);
    }

    protected function edit(array $workspace)
    {
        if (!ctype_digit($workspace['id'])) {
            throw new Error('Invalid workspace id');
        }
        $this->id = $workspace['id'];
        if (!is_string($workspace['name'])) {
            throw new Error('Invalid workspace name');
        }
        $this->name = $workspace['name'];
        if (!is_int($workspace['user_id'])) {
            throw new Error('Invalid user id');
        }
        $this->user_id = $workspace['user_id'];
        $dao = new WorkspaceDAO;
        $dao->update($this);
    }
}
