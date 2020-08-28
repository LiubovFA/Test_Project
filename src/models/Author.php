<?php

namespace test_project\src\models;

use PDO;
use test_project\src\classes\Db;

class Author extends Db
{
    private int $Id;
    private string $full_name;

    protected $db;

    public function __construct(PDO $db_connection)
    {
        $this->db = $db_connection;
    }

    public function getId()
    {
        return $this->Id;
    }

    public function getName()
    {
        return $this->full_name;
    }

    public function getAll()
    {
        $data = $this->db->query('SELECT * from Author')->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
}