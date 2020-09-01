<?php

namespace test_project\app\classes;

use ErrorException;
use function Composer\Autoload\includeFile;

class View
{
    private $layout;
    public $view;
    private $args = [];

    public function __construct($view = "")
    {
        $this->view = $view;
        $this->layout = $_SERVER['DOCUMENT_ROOT'].'/app/views/layout.php';
    }

    public function render (array $data = [])
    {
        //echo '<br>'.$path.'<br>';
        // Получаем путь, где лежат все представления
        $fullPath = $_SERVER['DOCUMENT_ROOT'].'/app/views/' . $this->view. '.php';

       // ob_start();
        //echo '<br>'.$fullPath.'<br>';
         // Если представление не было найдено, выбрасываем исключение
         if (!file_exists($fullPath)) {
             throw new ErrorException('view cannot be found');
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
        if($data != null)
        {
            $this->args = $data;
        }

         include $fullPath;

       //  $content = ob_get_clean();
         //echo '<br>';
        // print_r($data);

         //include $this->layout;
    }
}