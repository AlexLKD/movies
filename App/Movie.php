<?php

// Movie.php
class Movie {
    private $db;

    public function __construct() {
        try {
            // Create an instance of the Database class
            $this->db = Database::get();
        } catch (Exception $e) {
            // Handle the exception, e.g., log the error
            throw new Exception("Unable to connect to the database.");
        }
    }

    public function getMovieDetails($movieId) {
        try {
            $query = "SELECT * FROM movie WHERE id_movie = :movieId";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':movieId', $movieId, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            // Handle the exception, e.g., log the error
            throw new Exception("Error retrieving movie details from the database.");
        }
    }

    public function getActorsForMovie($movieId) {
        try {
            $query = "SELECT actor.* FROM actor
                      JOIN movie_has_actor ON actor.id_actor = movie_has_actor.actor_id_actor
                      WHERE movie_has_actor.movie_id_movie = :movieId";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':movieId', $movieId, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            // Handle the exception, e.g., log the error
            throw new Exception("Error retrieving actors for the movie from the database.");
        }
    }
}
