<?php

namespace test_project\app\classes;

class View
{
    public static function render (string $path, array $data = [])
    {
        // Получаем путь, где лежат все представления
        $fullPath = __DIR__ . '/src/views/' . $path . '.php';

         // Если представление не было найдено, выбрасываем исключение
         if (!file_exists($fullPath)) {
             throw new \ErrorException('view cannot be found');
         }

         // Если данные были переданы, то из элементов массива
         // создаются переменные, которые будут доступны в представлении
         if (!empty($data))
         {
             foreach ($data as $key => $value)
             {
                 $$key = $value;
             }
         }

         // Отображаем представление
        // подумать!!!

         include($fullPath);
    }
}