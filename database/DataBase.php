<?php

namespace database;

class DataBase
{
    private $conn;
    private $dbName = DB_NAME;
    private $dbHost = DB_HOST;
    private $dbPassword = DB_PASSWORD;
    private $dbUsername = DB_USERNAME;
    private $options = array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

    function __construct()
    {
        try {
            $this->conn = new \PDO("mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName, $this->dbUsername, $this->dbPassword, $this->options);
            echo 'database connected';
        }
        catch (\PDOException $e) {
            echo $e->getMessage();
            exit();
        }

    }
}

