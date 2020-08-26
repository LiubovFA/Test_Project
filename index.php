<?php

use test_project\src\models\Db;
use test_project\src\classes\Router;

require_once __DIR__ .'/vendor/autoload.php';


try
{
    echo 'Погнале! <br>';

    $router = new Router();
    $router->start();
}
catch (Exception $e)
{
    echo $e->getMessage();
}

