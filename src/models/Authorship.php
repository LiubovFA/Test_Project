<?php

use test_project\src\classes\Db;

class Authorship extends Db
{
    private $author_id;
    private $book_id;

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
        $request = $this->db->prepare('Select Id_book from Authorship WHERE Id_author = ?');
        $data = $request->execute();

    }



}