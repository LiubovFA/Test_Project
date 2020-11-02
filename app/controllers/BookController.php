<?php

namespace test_project\app\controllers;

use test_project\app\classes\Controller;
use test_project\app\models\Book;

class BookController extends Controller
{
    public function Read(int $Id)
    {
        //echo 'Зашли в BookController + '.$Id;
        $book = new Book();

        $data = $book->getAllInfo($Id);

        $this->view->setView("Read", "readBook");

        $this->showView('Чтение книги', $data);
    }

}
