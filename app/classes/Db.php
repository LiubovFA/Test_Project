<?php

namespace test_project\app\classes;

use PDO;
use PDOException;

include('app\config.php');

class Db
{
    public $connection;

    public function __construct()
    {
        if($this->connection instanceof PDO && $this->connection != null)
        {
            return true;
        }

        $dns = "sqlsrv:Server=".DB_HOST.";Database=".DB_NAME;

        $result_connect = null;
        try
        {
            $result_connect = new PDO($dns, DB_USER, DB_PASS);
            // $result_connect = odbc_connect("Driver={SQL Server};Server=".$this->connection["host"].";Database=".$this->connection["db_name"],$this->connection["user"], $this->connection["password"]);
            // $result_connect = new PDO("sqlsrv::Server=localhost;Database=".$this->connection["db_name"], $this->connection["user"], $this->connection["password"]);
        }
        catch (PdoException $ex)
        {
            echo $ex->getLine().' + '.$ex->getMessage( )." + ". (int)$ex->getCode( );
        }

        $this->connection = $result_connect;
        $this->connection->exec('set names utf8');
        echo ' DB is connected';
    }

    public function disconnect()
    {
        if ($this->connection instanceof PDO)
        {
            $db = null;
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }

}