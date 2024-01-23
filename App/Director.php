<?php

namespace App;

use Exception;
use PDO;
use PDOException;


class Director {
    private $dbCo;

    public function __construct() {
        $this->dbCo = Database::get();
    }

    public function getAllDirectors()
{
    $query = "SELECT * FROM director";
    $stmt = $this->dbCo->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}