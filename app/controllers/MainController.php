<?php

namespace test_project\app\controllers;

use Exception;
use test_project\app\classes\Controller;
use test_project\app\classes\View;

use test_project\app\models\Book;
use test_project\app\models\Author;

class MainController extends Controller
{
    /*public function __construct()
    {
        self::$view = new View();
       /* $db = new Db();
        try
        {
            $this->db_connection = $db->connect();
        }
        catch (\ErrorException $e)
        {
            echo $e->getMessage();
        }
    }*/

    public function index()
    {
        try {
            $book = new Book();

            $books = $book->getAll();

            $this->view->setView("Index", "books");

            $this->showView('Главная страница', $books);

            //   View::render('Index.php', $books);

           // echo '<a href="/test_project/authors">По автору</a>';

           /* echo '<br> Всего книг:'.count($books);

            for ($row = 0; $row < count($books); $row++)
            {
                echo "<p><b>Book Id".$books[$row]['Id_book']."</b></p>";
                echo "<ul>";
                    echo $books[$row]['Name'].'<br>';
                echo "</ul>";
            }
            echo '<br>';*/

            //self::showView('Index', $books);
            //$this->view
          //  View::render('Index.php');
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

            $this->showView('Главная страница', $authors);

            /*for ($row = 0; $row < count($authors); $row++)
            {
                echo "<p><b> Author Id".$authors[$row]['Id_author']."</b></p>";
                echo "<ul>";
                echo $authors[$row]['Full_name'].'<br>';
                echo "</ul>";
            }
            echo '<br>';*/

            //  View::render('Index.php');
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

            $this->view->setView("Index", "authorBooks");

            $this->showView('Главная страница', $books);

            /*
            for ($row = 0; $row < count($books); $row++)
            {
                echo "<p><b>Book Id".$books[$row]['Id_book']."</b></p>";
                echo "<ul>";
                echo $books[$row]['Name'].'<br>';
                echo "</ul>";
            }*/

           // self::showView('Index', $books);
        }
        catch(Exception $exc)
        {
            echo $exc->getCode().' + '.$exc->getMessage();
        }
    }
}