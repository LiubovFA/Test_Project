<?php

namespace test_project\src\models;

use PDO;
use test_project\src\classes\Db;

class Book extends Db
{
    private int $Id;
    private string $book_name;
    private string $content;
    protected $db;


    public function __construct(PDO $db_connection)
    {
        $this->db = $db_connection;
    }

    public function get_book_id()
    {
        return $this->Id;
    }

    public function get_book_name()
    {
        return $this->book_name;
    }

    public function get_book_content()
    {
        return $this->content;
    }

    public function getBookInfo()
    {
        $info = [
            "id" => $this->Id,
            "book_name" => $this->book_name,
            "content" => $this->content
            ];

        return $info;
    }

    public function getAll()
    {
        //$data = $this->db->query('SELECT Id_book, Name, Content from Book')->fetchAll(PDO::FETCH_UNIQUE);

        $data = $this->db->prepare('SELECT Id_book, Name, Content from Book');

        $type = null;
        $content = null;
        $id = null;
        if ($data->execute())
        {
            $data->bindColumn(1, $id, PDO::PARAM_INT);
            $data->bindColumn(2, $type, PDO::PARAM_STR, 400);
            $data->bindColumn(3, $content, \PDO::PARAM_LOB);

            return $data->fetchAll(\PDO::FETCH_BOUND) ?
                ["Id_book" => $id, "Name" => $type, "Content" => $content] : null;
        } else {
            return null;
        }

    }

}