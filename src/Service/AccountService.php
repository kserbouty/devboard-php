<?php

namespace Devboard\Service;

use Devboard\Domain\Account\User;
use Devboard\Database\DAO\UserDAO;
use Error;

class AccountService extends User
{
    static function login($id): void
    {
        try {
            $account = self::getAccount($id);
            session_start();
            $_SESSION['login'] = $account['id'];
            header('Location: /devboard/home');
        } catch (Error $e) {
            $message = "Login failed: " . $e->getMessage();
            $code = $e->getCode();
            throw new Error($message, $code);
        }
    }

    static function logout(): void
    {
        session_start();
        unset($_SESSION["login"]);
        header('Location: /devboard/');
    }

    static function register($account): void
    {
        try {
            $user = new User;
            $user->create($account);
            $id = $user->getId();
            self::login($id);
        } catch (Error $e) {
            $message = "Registration failed: " . $e->getMessage();
            $code = $e->getCode();
            throw new Error($message, $code);
        }
    }

    static function getAccounts(): array
    {
        $accounts = array();
        $dao = new UserDAO;
        $data = $dao->findAll();
        foreach ($data as $user) {
            $account['id'] = $user->getId();
            $account['username'] = $user->getUsername();
            $accounts[] = $account;
        }
        return $accounts;
    }

    static function getAccount($id): array
    {
        $dao = new UserDAO;
        $user = $dao->findById($id);
        $account['id'] = $user->getId();
        $account['username'] = $user->getUsername();
        return $account;
    }

    static function updateAccount($account): void
    {
        try {
            $user = new User;
            $user->edit($account);
        } catch (Error $e) {
            $message = "Update failed: " . $e->getMessage();
            $code = $e->getCode();
            throw new Error($message, $code);
        }
    }

    static function removeAccount($account): void
    {
        try {
            $user = new User;
            $user->remove($account);
        } catch (Error $e) {
            $message = "Remove failed: " . $e->getMessage();
            $code = $e->getCode();
            throw new Error($message, $code);
        }
    }
}
