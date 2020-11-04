<?php

namespace test_project\app\classes;

use ErrorException;

class View
{
    private $layout = 'app/views/layout.php';
    public $viewName;
    public $dataType;

    public function __construct()
    {
    }

    public function setView($view, $type = '')
    {
        $this->viewName = $view;
        $this->dataType = $type;
    }

    public function render ($title, $data = [])
    {
        // Получаем путь, где лежат все представления
        $fullPath = 'app/views/'.$this->viewName.'.php';

        $type = $this->dataType;
        // Если представление не было найдено, выбрасываем исключение
        if (!file_exists($fullPath)) {
            //$uri = $_SERVER['REQUEST_URI'];
            throw new ErrorException("View cannot be found $fullPath");
        }
        else {
            ob_start();
            include $fullPath;
            $content = ob_get_clean();
            include $this->layout;
        }
    }
}