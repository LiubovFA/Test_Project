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
            $result_connect->exec('set names utf8');

        }
        catch (PdoException $ex)
        {
            echo $ex->getLine().' + '.$ex->getMessage( )." + ". (int)$ex->getCode( );
            exit();
        }

        $this->connection = $result_connect;
        //echo 'DB is connected! <br>';
    }

    /*public function disconnect()
    {
        if ($this->connection instanceof PDO)
        {
            $this->connection = null;
        }
    }*/

    public function getConnection()
    {
        return $this->connection;
    }

}