<?php

namespace Devboard\Database\DAO;

use PDO;
use PDOException;

class DAO
{
    private string $driver;
    private string $dbname;
    private string $host;
    private string $username;
    private string $password;
    protected PDO $pdo;

    protected function connexion(): void
    {
        $this->config();
        $dsn = $this->driver . ':dbname=' . $this->dbname . ';host=' . $this->host;
        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password);
        } catch (PDOException $e) {
            $message = $e->getMessage();
            $code = $e->getCode();
            throw new PDOException($message, $code);
        }
    }

    private function config(): void
    {
        $filename = '../config/config.ini';
        $config = parse_ini_file($filename, true);
        $credentials = $config['credentials'];

        if (!isset($credentials)) {
            echo "Credentials are missing.";
            exit();
        }

        $this->driver = $credentials['driver'];
        $this->dbname = $credentials['dbname'];
        $this->host = $credentials['host'];
        $this->username = $credentials['username'];
        $this->password = $credentials['password'];
    }
}
