<?php

namespace test_project\app\models;

use PDO;
use test_project\app\App;

class Book
{
    private int $Id;
    private string $book_name;
    private string $content;


    public function __construct()
    {
    }

    public function getId()
    {
        return $this->Id;
    }

    public function getName()
    {
        return $this->book_name;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getAllInfo(int $Id)
    {
       $data = App::$db->getConnection()->prepare('Select Book.Id_book, Book.Name, A2.Full_name, Book.Content from Book
                                            inner join Authorship A on Book.Id_book = A.Id_book
                                            inner join Author A2 on A.Id_author = A2.Id_author
                                            Where A.Id_book = ?');
       if ($data->execute([$Id]))
       {
           return $data->fetchAll(PDO::FETCH_ASSOC);
       }
       else return null;
    }

    public function getAll()
    {
        //$data = $this->db->query('SELECT Id_book, Name, Content from Book')->fetchAll(PDO::FETCH_UNIQUE);

        $data = App::$db->getConnection()->prepare('SELECT Id_book, Name, Content from Book');

        $type = null;
        $content = null;
        $id = null;
        /*if ($data->execute())
        {
            $data->bindColumn(1, $id, PDO::PARAM_INT);
            $data->bindColumn(2, $type, PDO::PARAM_STR, 400);
            $data->bindColumn(3, $content, \PDO::PARAM_LOB);

            return $data->fetchAll(\PDO::FETCH_BOUND) ?
                ["Id_book" => $id, "Name" => $type, "Content" => $content] : null;
        } else {
            return null;
        }*/

        if ($data->execute()) {
            return $data->fetchAll(PDO::FETCH_BOTH);
        }
        else return null;

    }

    public function getBooksByAuthor(int $Id)
    {
        $query_books = App::$db->getConnection()->prepare('select Book.Id_book, Book.Name, Book.Content from Book
                                                    inner join Authorship A on Book.Id_book = A.Id_book
                                                    where A.Id_author = ?');
        if( $query_books->execute([$Id]))
        {
            return $query_books->fetchAll(PDO::FETCH_ASSOC);
        }
        else return null;
    }

}