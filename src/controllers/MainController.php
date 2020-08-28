<?php

namespace test_project\src\controllers;

use mysql_xdevapi\Exception;
use test_project\src\models\Book;
use test_project\src\models\Author;
use test_project\src\classes\Db;
use test_project\src\classes\View;

class MainController
{
    public $model;
    public $view;
    private \PDO $db_connection;


    public function __construct()
    {
        $db = new Db();
        try
        {
            $this->db_connection = $db->connect();
        }
        catch (\ErrorException $e)
        {
            echo $e->getMessage();
        }

    //    $this->view->generate('HomeView.php', 'template_view.php');
    }
    public function index()
    {
        echo 'это главная страница!';
        try {
            $book = new Book($this->db_connection);

            $books = $book->getAll();
            //   View::render('HomeView.php', $books);

            echo '<br> Всего книг:'.count($books);

            for ($row = 0; $row < count($books); $row++)
            {
                echo "<p><b>Book № $row</b></p>";
                echo "<ul>";
                    echo $books[$row]['Name'].'<br>';
                  //  echo $books[$row]['Content'].'<br>';
                echo "</ul>";
            }
            echo '<br>';

          //  View::render('HomeView.php');
        }
        catch (\Exception $exception)
        {
            echo $exception->getMessage();
        }
    }

    public function getAuthorList()
    {
        echo 'это список авторов!';
        try {
            $author = new Author($this->db_connection);

            $authors = $author->getAll();
            //   View::render('HomeView.php', $books);
            print_r($authors);
            //  View::render('HomeView.php');
        }
        catch (\Exception $exception)
        {
            echo $exception->getMessage();
        }
    }

    public function getBooks()
    {

    }
}