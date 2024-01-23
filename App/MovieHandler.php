<?php

namespace App;

use Exception;
use PDO;
use PDOException;

class MovieHandler
{
    private $dbCo;

    public function __construct() {
        $this->dbCo = Database::get();
    }

    public function addMovie($title, $synopsis, $director, $producer, $genres, $actors, $editions)
    {
        try {
            // Insert movie data into the database
            $movieId = $this->insertMovie($title, $synopsis, $director, $producer);

            // Insert genres, actors, and editions
            $this->insertGenres($movieId, $genres);
            $this->insertActors($movieId, $actors);
            $this->insertEditions($movieId, $editions);

            return "Movie added successfully!";
        } catch (Exception $e) {
            // Handle database errors
            return "Error adding movie: " . $e->getMessage();
        }
    }

    private function insertMovie($title, $synopsis, $director, $producer)
    {
        $query = "INSERT INTO movie (title, synopsis, director_id_director, producer_id_producer) VALUES (?, ?, ?, ?)";
        $stmt = $this->dbCo->prepare($query);
        $stmt->execute([$title, $synopsis, $director, $producer]);

        return $this->dbCo->lastInsertId();
    }

    private function insertGenres($movieId, $genres)
    {
        foreach ($genres as $genre) {
            $query = "INSERT INTO movie_has_genre (movie_id_movie, genre_id_genre) VALUES (?, ?)";
            $stmt = $this->dbCo->prepare($query);
            $stmt->execute([$movieId, $genre]);
        }
    }

    private function insertActors($movieId, $actors)
    {
        foreach ($actors as $actor) {
            $query = "INSERT INTO movie_has_actor (movie_id_movie, actor_id_actor) VALUES (?, ?)";
            $stmt = $this->dbCo->prepare($query);
            $stmt->execute([$movieId, $actor]);
        }
    }

    private function insertEditions($movieId, $editions)
    {
        foreach ($editions as $edition) {
            $query = "INSERT INTO movie_has_edition (movie_id_movie, edition_id_edition) VALUES (?, ?)";
            $stmt = $this->dbCo->prepare($query);
            $stmt->execute([$movieId, $edition]);
        }
    }
}
