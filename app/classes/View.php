<?php

namespace test_project\app\classes;

use ErrorException;

class View
{
    private $layout = 'app/views/layout.php';
    public $viewName;
    private $path;
    private $args = [];

    public function __construct()
    {
    }

    public function setView($view)
    {
        $this->viewName = $view;
    }

    public function render ($title, array $data = [])
    {
        // Получаем путь, где лежат все представления
        $fullPath = 'app/views/' . $this->viewName. '.php';

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

        // print_r($data);
         // Если данные были переданы, то из элементов массива
         // создаются переменные, которые будут доступны в представлении
         /*if (!empty($data))
         {
             foreach ($data as $key => $value)
             {
                 $$key = $value;
             }
         }*/
       /* if($data != null)
        {
            $this->args = $data;
        }

         include $fullPath;*/

       //  $content = ob_get_clean();
         //echo '<br>';
        // print_r($data);

         //include $this->layout;
    }
}