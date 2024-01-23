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
    return $stmt->fetchAll();
}

    public function getDirectorDetails($directorId) 
{
    $query = "SELECT * FROM director WHERE id_director = :directorId";
    $stmt = $this->dbCo->prepare($query);
    $stmt->bindParam(':directorId', $directorId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch();
}

    public function getDirectorName($directorId) 
{
    $directorDetails = $this->getDirectorDetails($directorId);
    return $directorDetails['first_name'] . ' ' . $directorDetails['last_name'];
}
}