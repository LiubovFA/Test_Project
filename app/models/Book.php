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
        $statement = 'Select Book.Id_book, Book.Name, A2.Full_name, Book.Content from Book
                                            inner join Authorship A on Book.Id_book = A.Id_book
                                            inner join Author A2 on A.Id_author = A2.Id_author
                                            Where A.Id_book = ? ORDER BY Book.Name';

        $query = App::$db->getConnection()->prepare($statement);
      // $array_data = array();

       if ($query->execute([$Id]))
       {
           $query->bindColumn('Id_book', $Id_book);
           $query->bindColumn('Name', $book_name);
           $query->bindColumn('Full_name', $author_name);
           $query->bindColumn('Content', $content, PDO::PARAM_LOB);

           $return_data = $query->fetchAll(PDO::FETCH_ASSOC);

           return $return_data;
       }
       else return null;
    }

    public function getAll()
    {
        //$data = $this->db->query('SELECT Id_book, Name, Content from Book')->fetchAll(PDO::FETCH_UNIQUE);
        $statement = 'SELECT Id_book, Name from Book ORDER BY Name';

        $query = App::$db->getConnection()->prepare($statement);

        if ($query->execute())
            return $query->fetchAll(PDO::FETCH_BOTH);
        else return null;
    }

    public function getFullBooksInfo()
    {
        $statement = 'select Book.Id_book, Book.Name, A2.Full_name from Book
                                                    inner join Authorship A on Book.Id_book = A.Id_book
                                                    inner join Author A2 on A.Id_author = A2.Id_author
                                                    ORDER BY Book.Name';

        $query = App::$db->getConnection()->prepare($statement);

        if( $query->execute([]))
        {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        else return null;
    }

    public function getBooksByAuthor(int $Id)
    {
        $statement = 'select Book.Id_book, Book.Name, A2.Full_name from Book
                                                    inner join Authorship A on Book.Id_book = A.Id_book
                                                    inner join Author A2 on A.Id_author = A2.Id_author
                                                    where A.Id_author = ? ORDER BY Book.Name';

        $query = App::$db->getConnection()->prepare($statement);
        if( $query->execute([$Id]))
            return $query->fetchAll(PDO::FETCH_ASSOC);
        else return null;
    }

    //поиск книги по названию
    public function searchByName (string $name)
    {
        $statement = 'select Book.Id_book, Book.Name, A2.Full_name from Book
                                                    inner join Authorship A on Book.Id_book = A.Id_book
                                                    inner join Author A2 on A2.Id_author = A.Id_author
                                                    where CONTAINS (Name, ?)';

        $arg = '"'.$name.'"';

        $query = App::$db->getConnection()->prepare($statement);

        if ($query->execute([$arg]))
            return $query->fetchAll(PDO::FETCH_ASSOC);
        else return null;
    }

    //поиск книги по автору
    public function searchByAuthor (int $id)
    {
        $statement = 'select Book.Id_book, Book.Name, A2.Full_name, A2.Id_author from Book
                                                    inner join Authorship A on Book.Id_book = A.Id_book
                                                    inner join Author A2 on A2.Id_author = A.Id_author
                                                    where A.Id_author = ? ORDER BY A2.Id_author';

        $query = App::$db->getConnection()->prepare($statement);

        if ($query->execute([$id]))
            return $query->fetchAll(PDO::FETCH_ASSOC);
        else return null;
    }
}