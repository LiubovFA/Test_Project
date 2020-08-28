<?php
namespace test_project\src\classes;

//use test_project\src\controllers\MainController;

class Router
{
    public function __construct()
    {
       // echo ' рутер создан';
       // echo '<br>';
    }

    public function start()
    {
        // localhost/path
        //получение пути
        $path = $this->getURI();

        //парсинг пути
        $route = urldecode((parse_url($path, PHP_URL_PATH)));

        echo ' route='.$route.'<br>';
        print_r($route);
        echo '<br>';

        $uri_parts = explode('/', $route);

        print_r($uri_parts);
        echo '<br>';

        $index = -1;

        if (count($uri_parts)>2)
        {
            $index = $uri_parts[3];
        }

        //имеющиеся маршруты
        $routes = [
            "/test_project/"        => ['controller' => "Main", 'action' => "index"],
            "/test_project/authors" => ['controller' => "Main", 'action' => "getAuthorList"],
            "/test_project/authors/[0-9]+" => ['controller'=> "Main", 'action' => 'getBooksByAuthor', 'parameter' => $index],
            "/test_project/books" => ['controller' => "Main", 'action' => 'getAll'],
            "/test_project/books/[0-9]+" => ['controller'=> "Book", 'action' => "Read", 'parameter' => $index]
        ];

        print_r($routes);
        echo '<br>';

        //если путь существует
        if (isset($routes[$route]))
        {
            //вызов нужного контроллера и метода
            $controller = 'test_project\\src\\controllers\\'.$routes[$route]['controller'].'Controller';

           // echo ' controller='.$controller;

            $ctrl_obj = new $controller();
            $ctrl_obj->{$routes[$route]['action']}();
        }
        else
        {
            echo ' no path';
        }
    }

    private function getURI()
    {
        return $_SERVER['REQUEST_URI'];
    }
}