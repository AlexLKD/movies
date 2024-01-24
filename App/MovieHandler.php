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
            $movieId = $this->insertMovie($title, $synopsis, $director, $producer);
            $this->insertGenres($movieId, $genres);
            $this->insertActors($movieId, $actors);
            $this->insertEditions($movieId, $editions);

            return "Movie added successfully!";
        } catch (Exception $e) {
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

    public function getMovies($searchQuery = null)
    {
        $query = "SELECT * FROM movie";
        if ($searchQuery) {
            $query .= " WHERE title LIKE :searchQuery";
        }
        $stmt = $this->dbCo->prepare($query);
        if ($searchQuery) {
            $stmt->bindValue(':searchQuery', '%' . $searchQuery . '%', PDO::PARAM_STR);
        }
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // public function searchMovies($searchTerm)
    // {
    //     $query = "SELECT * FROM movie WHERE title LIKE :searchTerm";
    //     $stmt = $this->dbCo->prepare($query);
    //     $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
    //     $stmt->execute();
    //     return $stmt->fetchAll();
    // }

    public function searchMoviesWithDetails($searchTerm, $director = null, $genre = null, $actor = null)
    {
        // Build the basic query
        $query = "SELECT movie.*, director.first_name AS director_first_name, director.last_name AS director_last_name,
                  GROUP_CONCAT(DISTINCT genre.name) AS genre_names,
                  GROUP_CONCAT(DISTINCT actor.first_name, ' ', actor.last_name) AS actor_names
                  FROM movie
                  LEFT JOIN director ON movie.director_id_director = director.id_director
                  LEFT JOIN movie_has_genre ON movie.id_movie = movie_has_genre.movie_id_movie
                  LEFT JOIN genre ON movie_has_genre.genre_id_genre = genre.id_genre
                  LEFT JOIN movie_has_actor ON movie.id_movie = movie_has_actor.movie_id_movie
                  LEFT JOIN actor ON movie_has_actor.actor_id_actor = actor.id_actor
                  WHERE movie.title LIKE :searchTerm";
    
        // Append additional conditions based on the provided filters
        if ($director) {
            $query .= " AND movie.director_id_director = :director";
        }
        if ($genre) {
            $query .= " AND genre.id_genre = :genre"; // Modifier ici
        }
        if ($actor) {
            $query .= " AND actor.id_actor = :actor"; // Modifier ici
        }
    
        $query .= " GROUP BY movie.id_movie";
    
        $stmt = $this->dbCo->prepare($query);
    
        // Bind parameters
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        if ($director) {
            $stmt->bindParam(':director', $director, PDO::PARAM_STR);
        }
        if ($genre) {
            $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
        }
        if ($actor) {
            $stmt->bindParam(':actor', $actor, PDO::PARAM_STR);
        }
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    


}
