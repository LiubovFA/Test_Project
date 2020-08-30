<?php

namespace test_project\app\controllers;

use test_project\app\models\Book;
use test_project\app\classes\View;

class BookController
{
    public View $view;

    public function Read(int $Id)
    {
        echo 'Зашли в BookController + '.$Id;
        $book = new Book();

        $data = $book->getAllInfo($Id);

        echo '<br>'.$data[0]['Id_book'];
        echo '<br>'.$data[0]['Name'];
        echo '<br>'.$data[0]['Full_name'];
        echo '<br>'.$data[0]['Content'];
        echo '<br>';
    }

}
