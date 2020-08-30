<?php
namespace test_project\app\classes;

//use test_project\src\controllers\MainController;

class Router
{
    private $routes = [
        "#^/test_project/$#"        => ['controller' => "Main", 'action' => "index", 'arg' => ''],
        "#^/test_project/authors$#" => ['controller' => "Main", 'action' => "getAuthorList", 'arg' => ''],
        "#^/test_project/authors/([0-9]+)$#" => ['controller'=> "Main", 'action' => 'getBooksByAuthor', 'arg' => ''],
        "#^/test_project/books$#" => ['controller' => "Main", 'action' => 'getAll', 'arg' => ''],
        "#^/test_project/books/([0-9]+)$#" => ['controller'=> "Book", 'action' => "Read", 'arg' => '']
    ];

    private $controller;
    private $action;
    private $arg;

    public function __construct()
    {
       $this->controller = 'Home';
       $this->action = 'index';
       $this->arg = '';
    }

    public function start()
    {
        // localhost/path
        //получение пути
        //$path = $this->getURI();

        //парсинг пути
       // $route = urldecode((parse_url($path, PHP_URL_PATH)));

        /*echo ' route='.$route.'<br>';
        print_r($route);
        echo '<br>';*/

        $path = $this->getURI();

       // echo 'request_uri = '.$path.' <br>';

       // $uri_parts = array_filter(explode('/', $path));

        // print_r($uri_parts);
        //echo count($uri_parts).'<br>';
       //$index = -1;
        /*if (count($uri_parts)>2)
        {
            $index = $uri_parts[3];
        }*/

        //имеющиеся маршруты
       /* $routes = [
            "#^/test_project/$#"        => ['controller' => "Main", 'action' => "index", 'arg' => ''],
            "#^/test_project/authors$#" => ['controller' => "Main", 'action' => "getAuthorList", 'arg' => ''],
            "#^/test_project/authors/([0-9]+)$#" => ['controller'=> "Main", 'action' => 'getBooksByAuthor', 'arg' => ''],
            "#/test_project/books#" => ['controller' => "Main", 'action' => 'getAll', 'arg' => ''],
            "#/test_project/books/([0-9]+)#" => ['controller'=> "Book", 'action' => "Read", 'arg' => '']
        ];*/

        foreach($this->routes as $uri => $params)
        {
            $result = preg_match($uri, $path,$match);
            if ($result)
            {
                echo '<br>';
                print_r($match);
                echo '<br>';

                print_r($params);
                echo '<br>';

                $path_parts = array_filter(explode('/', $path));

                $controller = 'test_project\\app\\controllers\\'.$params['controller'].'Controller';

                $ctr_obj = new $controller;
                $action = $params['action'];

                print_r($path_parts);
                echo '<br>';

                if (count($path_parts)>2) {
                    $arg = $path_parts[3];
                    echo $arg. '<br>';
                    $ctr_obj->$action($arg);
                }
                else
                {
                    $ctr_obj->$action();
                }
            }
        }

       /* print_r($routes);
        echo '<br>';

        //если путь существует
        if (isset($routes[$route]))
        {
            //вызов нужного контроллера и метода
            $controller = 'test_project\\src\\controllers\\'.$routes[$route]['controller'].'Controller';

           // echo ' controller='.$controller;

            $ctrl_obj = new $controller();
            if(count($uri_parts)>2) {
                $routes[$route]['parameter'] = $uri_parts[3];
                $ctrl_obj->{$routes[$route]['action']}($routes[$route]['parameter']);
            }
            else {
                $ctrl_obj->{$routes[$route]['action']}();
            }
        }
        else
        {
            echo ' no path';
        }*/
    }

    private function getURI()
    {
        return $_SERVER['REQUEST_URI'];
    }
}