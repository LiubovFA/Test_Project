<?php

namespace test_project\app\controllers;

use Exception;
use test_project\app\classes\Controller;
use test_project\app\classes\View;

use test_project\app\models\Book;
use test_project\app\models\Author;

class MainController extends Controller
{
    public function index()
    {
        try {
            $book = new Book();

            $books = $book->getFullBooksInfo();

            $this->view->setView("Index", "books");

            $this->showView('Список книг', $books);
        }
        catch (Exception $exception)
        {
            echo $exception->getMessage();
        }
    }

    public function getAuthorList()
    {
        try {
            $author = new Author();

            $authors = $author->getAll();

            $this->view->setView("Index", "authors");

            $this->showView('Список авторов', $authors);
        }
        catch (Exception $exception)
        {
            echo $exception->getMessage();
        }
    }

    public function getBooksByAuthor(int $Id)
    {
        //echo 'Мы в методе получения списка книг автора + '.$Id;
        try {
            $book = new Book();

            $books = $book->getBooksByAuthor($Id);

            $this->view->setView("Index", "authorbooks");

            $this->showView('Книги автора', $books);
        }
        catch(Exception $exc)
        {
            echo $exc->getCode().' + '.$exc->getMessage();
        }
    }

    public function search()
    {
        $this->view->setView("Index", "search");

        $this->showView('Поиск книги');
    }

    public function searchBook ()
    {
        if (isset($_POST['submit']))
        {
            if ($_POST['request'] != "")
            {
                $request = $_POST['request'];

                switch ($_POST['searchBy'])
                {
                    case 'book': //поиск по названию
                    {
                        try
                        {
                            $book = new Book();
                            $data = $book->searchByName($request);
                            $this->view->setView("Index", "search_book");

                            if (is_null($data) || empty($data))
                            {
                                $this->showView('Поиск книги', "Книга не найдена!");
                            }
                            else
                                $this->showView('Поиск книги', $data);
                        }
                        catch (Exception $ex)
                        {
                            echo $ex->getCode().' + '.$ex->getMessage();
                        }
                        break;
                    }
                    case 'author': //поиск по автору
                    {
                        try
                        {
                            $author = new Author();
                            $data = $author->searchAuthor($request);
                            $this->view->setView("Index", "search_author");

                            if (is_null($data) || empty($data))
                            {
                                $this->showView('Поиск книги', "Автор не найден!");
                            }
                            else
                            {
                                $book = new Book();
                                $data = $book->searchByAuthor($data[0]['Id_author']);
                                $this->showView('Поиск книги', $data);
                            }
                        }
                        catch (Exception $ex)
                        {
                            echo $ex->getCode().' + '.$ex->getMessage();
                        }
                        break;
                    }
                }
                exit();
            }
            else {
                $this->view->setView("Index", "search");
                $this->showView('Поиск книги', "Введите данные для поиска!");
            }
        }
    }
}