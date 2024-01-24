<?php
namespace App;

use Exception;
use PDO;

class Actor {
    private $dbCo;

    public function __construct() {
        $this->dbCo = Database::get();
    }

    public function getAllActors() {
        try {
            $query = "SELECT * FROM actor";
            $stmt = $this->dbCo->prepare($query);
            $stmt->execute();

            // Fetch the results
            return $stmt->fetchAll();
        } catch (Exception $e) {
            // Handle the exception, e.g., log the error
            throw new Exception("Error retrieving actors from the database.");
        }
    }

public function getActorsNames($movieId) {
    $query = "SELECT a.first_name, a.last_name FROM actor a
              JOIN movie_has_actor mha ON a.id_actor = mha.actor_id_actor
              WHERE mha.movie_id_movie = :movieId";
    
    $stmt = $this->dbCo->prepare($query);
    $stmt->bindParam(':movieId', $movieId, PDO::PARAM_INT);
    $stmt->execute();

    $actorNames = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $actorNames[] = $row['first_name'] . ' ' . $row['last_name'];
    }

    return implode(', ', $actorNames);
}


    public function getActorDetails($actorId) {
        $query = "SELECT * FROM actor WHERE id_actor = :actorId";
        $stmt = $this->dbCo->prepare($query);
        $stmt->bindParam(':actorId', $actorId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }
}