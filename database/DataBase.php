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
        } catch (\PDOException $e) {
            echo $e->getMessage();
            exit();
        }

    }

    //////// CRUD ////////
    // Select
    public function select($sql, $value=null)
    {
        try {
            $stmt = $this->conn->prepare($sql);
            if ($value == null) {
                $stmt->execute();
            } else {
                $stmt->execute($value);
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return $stmt;
    }

    // Insert
    public function insert($tableName, $fields, $values)
    {
        try {
            $sql = "INSERT INTO " . $tableName . "(" . implode(', ', $fields) . " ,created_at) VALUES ( :" . implode(', :', $fields) . " , now() );";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array_combine($fields, $values));
            return true;
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Update
    // update('users', 2, ['username', 'password'], ['alik2', 12345]);
    public function update($tableName, $id, $fields, $values)
    {

        $sql = "UPDATE " . $tableName . " SET";
        foreach(array_combine($fields, $values) as $field => $value)
        {
            if($value)
            {
                $sql .= " `" . $field . "` = ? ,";
            }
            else{
                $sql .= " `" . $field . "` = NULL ,";

            }
        }

        $sql .= " updated_at = now()";
        $sql .= " WHERE id = ?";
        try{
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array_merge(array_filter(array_values($values)), [$id]));
            return true;
        }

        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    // Delete
    // delete('users', 2);
    public function delete($tableName, $id)
    {
        $sql = "DELETE FROM " . $tableName . " WHERE id = ? ;";
        try{
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            return true;
        }

        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
}

