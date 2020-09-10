<?php

namespace test_project\app\classes;

use Exception;
//use test_project\app\classes\View;

abstract class Controller
{
   // protected $view;

    public function __construct()
    {
       // $this->view = new View();
    }

    public function showView($title, $data = [])
    {
        try {
          //  $this->view->render($title, $data);
        }
        catch (Exception $e)
        {
            echo $e->getCode() .' + '. $e->getMessage();
        }
    }
}