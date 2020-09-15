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
       $array_data = array();

       if ($data->execute([$Id]))
       {
           $data->bindColumn('Id_book', $Id_book);
           $data->bindColumn('Name', $book_name);
           $data->bindColumn('Full_name', $author_name);
           $data->bindColumn('Content', $content, PDO::PARAM_LOB);

           $return_data = $data->fetchAll(PDO::FETCH_ASSOC);

           return $return_data;
          /* $i = 0;
           while ($data->fetch(PDO::FETCH_BOUND))
           {

               var_dump($data);
              // echo $data['Id_book']."<br>";
               extract($data);
               $array_data[$i] = array('Id_book' => $Id_book,
                                       'Name' => $book_name,
                                       'Full_name' => $author_name,
                                       'Content' => $content);
           }

           //$data->fetchAll(PDO::FETCH_BOUND);

           echo "количество строк в array data: ".count($array_data)."<br>";

           return $array_data;*/
       }
       else return null;
    }

    public function getAll()
    {
        //$data = $this->db->query('SELECT Id_book, Name, Content from Book')->fetchAll(PDO::FETCH_UNIQUE);

        $data = App::$db->getConnection()->prepare('SELECT Id_book, Name from Book');

       /* $type = null;
        $content = null;
        $id = null;*/
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
        $query_books = App::$db->getConnection()->prepare('select Book.Id_book, Book.Name from Book
                                                    inner join Authorship A on Book.Id_book = A.Id_book
                                                    where A.Id_author = ?');
        if( $query_books->execute([$Id]))
        {
            return $query_books->fetchAll(PDO::FETCH_ASSOC);
        }
        else return null;
    }

}