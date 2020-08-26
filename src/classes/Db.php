<?php

namespace test_project\src\classes;

//use PDO;

use PDO;
use PDOException;

class Db
{
    private $host = "localhost";
    private $user = "user1";
    private $password = "sa";
    private $db_name = "bookshelf_db";

    protected $connection = null;

   /* public function __construct($con = null)
    {
        if(!is_null($con))
        {
            $this->db = $con;
        }
    }*/

    public function connect()
    {
        if($this->connection instanceof PDO && $this->connection->ping())
        {
            return true;
        }

        $dns = "sqlsrv:Server=".$this->host.";Database=".$this->db_name;

        $result_connect = null;
        try
        {
            $result_connect = new PDO($dns, $this->user, $this->password);
           // $result_connect = odbc_connect("Driver={SQL Server};Server=".$this->connection["host"].";Database=".$this->connection["db_name"],$this->connection["user"], $this->connection["password"]);
           // $result_connect = new PDO("sqlsrv::Server=localhost;Database=".$this->connection["db_name"], $this->connection["user"], $this->connection["password"]);
        }
        catch (PdoException $ex)
        {
            echo $ex->getLine().' + '.$ex->getMessage( )." + ". (int)$ex->getCode( );
        }

        $this->connection = $result_connect;
        echo ' DB is connected';
        return $this->connection;
    }

    private function disconnect()
    {
        if ($this->db instanceof PDO && $this->db->ping())
        {
            $db = null;
        }
    }
}