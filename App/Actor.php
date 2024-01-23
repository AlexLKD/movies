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

    public function getActorDetails($actorId) {
        $query = "SELECT * FROM actor WHERE id_actor = :actorId";
        $stmt = $this->dbCo->prepare($query);
        $stmt->bindParam(':actorId', $actorId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }
}