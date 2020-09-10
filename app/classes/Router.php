<?php
namespace test_project\app\classes;

use test_project\app\controllers\MainController;
use test_project\app\controllers\BookController;

class Router
{
    private $routes = [
        "#^/test_project$#"        => ['controller' => "Main", 'action' => "index", 'arg' => ''],
        "#^/test_project/authors$#" => ['controller' => "Main", 'action' => "getAuthorList", 'arg' => ''],
        "#^/test_project/authors/([0-9]+)$#" => ['controller'=> "Main", 'action' => 'getBooksByAuthor', 'arg' => ''],
        "#^/test_project/books$#" => ['controller' => "Main", 'action' => 'index', 'arg' => ''],
        "#^/test_project/books/([0-9]+)$#" => ['controller'=> "Book", 'action' => "Read", 'arg' => '']
    ];

    private $controller;
    private $action;
    private $arg;

    public function __construct()
    {
       $this->controller = 'Main';
       $this->action = 'index';
       $this->arg = '';
    }

    public function start()
    {
        echo 'Router is created! <br>';
        $path = $this->getURI();

        echo "request_uri = $path <br>";

        foreach($this->routes as $uri => $params)
        {
            $result = preg_match($uri, $path,$match);
            if ($result)
            {
                $path_parts = array_filter(explode('/', $path));

                $controller = 'test_project\\app\\controllers\\'.$params['controller'].'Controller';

                $ctr_obj = new $controller();
                $action = $params['action'];

                //print_r($path_parts);

                if (count($path_parts)>2) {
                    $arg = $path_parts[3];
                    $ctr_obj->$action($arg);
                }
                else
                {
                    $ctr_obj->$action();
                }
            }
        }
    }

    private function getURI()
    {
        $query = rtrim($_SERVER['REQUEST_URI'], "/");
        echo $_SERVER['REQUEST_URI'].' $query is '.$query.' ';
        return $query;
    }
}