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
        $statement = 'Select Full_name from Author where Id_author = ?';

        $name = App::$db->getConnection()->prepare($statement);

        if ($name->execute([$id]))
        {
            return $name->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function getAll()
    {
        $statement = 'SELECT * from Author';

        $data = App::$db->getConnection()->query($statement)->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function searchAuthor (string $name)
    {
        $statement = 'select Author.Id_author, Author.Full_name from Author
                      where Contains (Full_name, ?)';

        $arg = '"'. $name . '"';

        $query = App::$db->getConnection()->prepare($statement);
        if ($query->execute([$arg]))
        {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        else return null;
    }
}