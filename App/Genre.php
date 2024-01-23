<?php

namespace App;

use Exception;
use PDO;
use PDOException;

class Genre {
    private $dbCo;

    public function __construct() {
        $this->dbCo = Database::get();
    }

    public function getAllGenres()
{
    $query = "SELECT * FROM genre";
    $stmt = $this->dbCo->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}