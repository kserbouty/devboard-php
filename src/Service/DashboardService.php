<?php

namespace Devboard\Service;

use Devboard\Database\DAO\WorkspaceDAO;
use Devboard\Domain\Dashboard\Workspace;
use Error;

class DashboardService extends Workspace
{
    static function getWorkspaces(): array
    {
        $workspaces = array();
        $dao = new WorkspaceDAO;
        $data = $dao->findAll();
        foreach ($data as $object) {
            $workspace['id'] = $object->getId();
            $workspace['name'] = $object->getName();
            $workspaces[] = $workspace;
        }
        return $workspaces;
    }

    static function addWorkspace($data)
    {
        try {
            $workspace = new Workspace;
            $workspace->create($data);
        } catch (Error $e) {
            $message = "Workspace creation failed: " . $e->getMessage();
            $code = $e->getCode();
            throw new Error($message, $code);
        }
    }

    static function updateWorkspace($data)
    {
        try {
            $workspace = new Workspace;
            $workspace->edit($data);
        } catch (Error $e) {
            $message = "Workspace update failed: " . $e->getMessage();
            $code = $e->getCode();
            throw new Error($message, $code);
        }
    }
}
