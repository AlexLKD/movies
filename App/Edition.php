<?php

namespace App;

use Exception;
use PDO;
use PDOException;

class Edition {
    private $dbCo;

    public function __construct() {
        $this->dbCo = Database::get();
    }

    public function getAllEditions()
{
    $query = "SELECT * FROM edition";
    $stmt = $this->dbCo->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}