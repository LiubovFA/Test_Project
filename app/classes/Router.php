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
        "#^/test_project/books/([0-9]+)$#" => ['controller'=> "Book", 'action' => "Read", 'arg' => ''],
        "#^/test_project/searchbook$#" => ['controller'=> "Main", 'action' => "searchBook", 'arg' => ''],
        "#^/test_project/search$#" => ['controller' => "Main", 'action' => "search", 'arg' => '']
    ];

    private $controller = 'Main';
    private $action = 'index';
    private $arg = '';

    public function __construct()
    {
       /*$this->controller = 'Main';
       $this->action = 'index';
       $this->arg = '';*/
    }

    public function start()
    {
        //echo 'Router is created! <br>';
        $path = $this->getURI();

       // echo "request_uri = $path <br>";

        foreach($this->routes as $uri => $params)
        {
           // echo 'check <br>';
            $result = preg_match($uri, $path,$match);
            if ($result)
            {
                $path_parts = array_filter(explode('/', $path));

                $controller = 'test_project\\app\\controllers\\'.$params['controller'].'Controller';

                $ctr_obj = new $controller();
                $action = $params['action'];

                //print_r($path_parts);

                if (array_key_exists(3, $path_parts)) {
                    $arg = $path_parts[3];
                    $ctr_obj->$action($arg);
                }
                else
                {
                    $ctr_obj->$action();
                }
                break;
            }
        }
    }

    private function getURI()
    {
        $query = rtrim($_SERVER['REQUEST_URI'], "/");
       // echo $_SERVER['REQUEST_URI'].' $query is '.$query.' ';
        return $query;
    }
}