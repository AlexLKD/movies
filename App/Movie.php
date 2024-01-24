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

    public function getGenresForMovie($movieId)
    {
        $query = "SELECT genre.name FROM genre
                  INNER JOIN movie_has_genre ON genre.id_genre = movie_has_genre.genre_id_genre
                  WHERE movie_has_genre.movie_id_movie = ?";
        $stmt = $this->dbCo->prepare($query);
        $stmt->execute([$movieId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addGenreForMovie($movieId, $genreId)
    {
        $query = "INSERT INTO movie_has_genre (movie_id_movie, genre_id_genre) VALUES (?, ?)";
        $stmt = $this->dbCo->prepare($query);
        $stmt->execute([$movieId, $genreId]);
    }

    public function deleteGenreForMovie($movieId, $genreId)
    {
        $query = "DELETE FROM movie_has_genre WHERE movie_id_movie = ? AND genre_id_genre = ?";
        $stmt = $this->dbCo->prepare($query);
        $stmt->execute([$movieId, $genreId]);
    }
}

