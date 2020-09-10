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
        $dns = "sqlsrv:Server=".DB_HOST.";Database=".DB_NAME;

        $result_connect = null;

        try
        {
            $result_connect = new PDO($dns, "", "");
        }
        catch (PdoException $ex)
        {
            echo $ex->getLine().' + '.$ex->getMessage( )." + ". (int)$ex->getCode( );
        }

        $this->connection = $result_connect;
        $this->connection->exec('set names utf8');
        echo 'DB is connected! <br>';
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