<?php

namespace App;

use Exception;
use PDO;
use PDOException;

class Producer {
    private $dbCo;

    public function __construct() {
        $this->dbCo = Database::get();
    }

    public function getAllProducers()
{
    $query = "SELECT * FROM producer";
    $stmt = $this->dbCo->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}