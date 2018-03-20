<?php

require_once LIB_PATH . DS . "config.php";

class PDODatabase
{
    private $connection;

    public function __construct()
    {
        $this->openConnection();
    }

    // Connection functions
    public function openConnection()
    {
        $serverString = "mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME ."";

        try {
            $this->connection = new PDO($serverString, DB_USER, DB_PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $msg =  "Connection failed: " . $e->getMessage();
            die($msg);
        }
    }

    public function closeConnection()
    {
        if (isset($this->connection)) {
            unset($this->connection);
        }
    }

    // Database query functions
    public function query($sql)
    {
        $stmnt = $this->connection->prepare($sql);
        $stmnt->execute();

        $stmnt->setFetchMode(PDO::FETCH_ASSOC);

        return $stmnt;
    }

    private function confirmQuery($result, $sql = "")
    {
        if (!$result) {
            throw new Exception($sql . ' failed');
        }
    }

    public function escapeValue($string)
    {
        return $string;
    }

    // Database neutral functions
    public function fetchArray($result_set)
    {
        return $result_set->fetchAll();
    }

    public function numRows($result_set)
    {
        return $result_set->rowCount();
    }

    public function insertID()
    {
        // get the last id inserted over the current database connection
        return $this->connection->lastInsertId();
    }

    public function affectedRows()
    {
        return 0;
    }
}

$database = new PDODatabase();
$db       = &$database;
