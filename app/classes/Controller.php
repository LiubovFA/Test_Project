<?php

namespace test_project\app\classes;

use Exception;
use test_project\app\classes\View;

abstract class Controller
{
    protected static View $view;

    public static function showView($viewName, $data = [])
    {
        try {
            self::$view = new View($viewName);
            self::$view->render($data);

        } catch (Exception $e)
        {
            echo $e->getCode() .' + '. $e->getMessage();
        }
    }
}