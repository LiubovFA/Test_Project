<?php

namespace test_project\app\models;

use PDO;
use test_project\app\App;

class Author
{
    private int $Id;
    private string $full_name;

    public function getId()
    {
        return $this->Id;
    }

    public function getName()
    {
        return $this->full_name;
    }

    public function getNameById(int $id)
    {
        $name = App::$db->getConnection()->prepare('Select Full_name from Author where Id_author = ?');

        if ($name->execute([$id]))
        {
            return $name->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function getAll()
    {
        $data = App::$db->getConnection()->query('SELECT * from Author')->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function searchAuthor (string $name)
    {
        $query = App::$db->getConnection()->prepare('select Author.Id_author, Author.Full_name from Author
                                                    where Contains (Full_name, ?)');
        if ($query->execute([$name]))
        {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        else return null;
    }
}