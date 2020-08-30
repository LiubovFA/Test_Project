<?php
namespace test_project\app;

use test_project\app\classes\Db;
use test_project\app\classes\Router;

class App
{
    public static Router $router;
    public static Db $db;

    public static function init()
    {
        self::$db = new Db();
        self::$router = new Router();
        self::$router->start();
    }
}