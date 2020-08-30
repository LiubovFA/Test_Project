<?php

namespace test_project\app\models;

use PDO;
use test_project\app\App;

class Authorship
{
    private $author_id;
    private $book_id;

    private PDO $db;

    public function __construct(PDO $connection)
    {
        $this->db = $connection;
    }

    public function getBookId()
    {
        return $this->book_id;
    }

    public function getAuthorId()
    {
        return $this->author_id;
    }

    public function getBooksByAuthor(int $id_author)
    {
        $request = App::$db->getConnection()->prepare('Select Id_book from Authorship WHERE Id_author = ?');
        if ($request->execute([$id_author]))
            return $request->fetchALL(PDO::FETCH_ASSOC);
        else
            return null;
    }
}