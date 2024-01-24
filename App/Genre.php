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

public function getGenreNames($movieId) {
    $query = "SELECT g.name FROM genre g
              JOIN movie_has_genre mhg ON g.id_genre = mhg.genre_id_genre
              WHERE mhg.movie_id_movie = :movieId";
    
    $stmt = $this->dbCo->prepare($query);
    $stmt->bindParam(':movieId', $movieId, PDO::PARAM_INT);
    $stmt->execute();

    $genreNames = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $genreNames[] = $row['name'];
    }

    return implode(', ', $genreNames);
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