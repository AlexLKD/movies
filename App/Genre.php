<?php

namespace App;

use Exception;
use PDO;
use PDOException;

class Genre {
    private $dbCo;

    public function __construct() 
{
        $this->dbCo = Database::get();
}

    public function getAllGenres()
{
    $query = "SELECT * FROM genre";
    $stmt = $this->dbCo->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function getGenreDetails($genreId) 
{
    $query = "SELECT * FROM genre WHERE id_genre = :genreId";
    $stmt = $this->dbCo->prepare($query);
    $stmt->bindParam(':genreId', $genreId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
}