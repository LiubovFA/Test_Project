<?php

namespace test_project\app\classes;

use ErrorException;

class View
{
    private $layout = 'app/views/layout.php';
    public $viewName;
    public $dataType;
   // private $path;
   // private $args = [];

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
            throw new ErrorException('View cannot be found');
        }
        else {
            ob_start();
            include $fullPath;
            $content = ob_get_clean();
            include $this->layout;
        }
    }
}