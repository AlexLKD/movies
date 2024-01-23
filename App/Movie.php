<?php

namespace App;

use Exception;
use PDO;
use PDOException;
class Movie {
    private $dbCo;

    public function __construct() {
        $this->dbCo = Database::get();
    }

    public function getAllMovies()
    {
        $query = "SELECT * FROM movie";
        $stmt = $this->dbCo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllEditionForEveryMovie() {
        try {
            $query = "SELECT m.id_movie, m.title AS movie_title, GROUP_CONCAT(e.type) AS available_editions
            FROM movie m
            LEFT JOIN movie_has_edition me ON m.id_movie = me.movie_id_movie
            LEFT JOIN edition e ON me.edition_id_edition = e.id_edition
            GROUP BY m.id_movie, m.title;";
            $stmt = $this->dbCo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();

        } catch (Exception $e) {
            throw new Exception ("Error retrieving editions available for every movie.");
        }
    }
}

