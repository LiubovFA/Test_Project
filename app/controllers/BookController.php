<?php

namespace test_project\app\controllers;

use test_project\app\classes\Controller;
use test_project\app\models\Book;
use test_project\app\classes\View;

class BookController extends Controller
{
    public View $view;

    public function Read(int $Id)
    {
        echo 'Зашли в BookController + '.$Id;
        $book = new Book();

        $data = $book->getAllInfo($Id);

        $this->view->setView("Read");

        $this->showView('Чтение книги', $data);
    }

}
