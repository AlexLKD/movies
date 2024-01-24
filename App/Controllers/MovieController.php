<?php
namespace App\Controllers;

use App\Movie;
use App\MovieHandler;

class MovieController
{
    private $movieHandler;
    private $movie;

    public function __construct()
    {
        $this->movieHandler = new MovieHandler();
        $this->movie = new Movie();
    }

    public function addMovie()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = isset($_POST['title']) ? $_POST['title'] : '';
            $synopsis = isset($_POST['synopsis']) ? $_POST['synopsis'] : '';
            $directorId = isset($_POST['directors']) ? $_POST['directors'][0] : '';
            $producerId = isset($_POST['producers']) ? $_POST['producers'][0] : '';
            $genreIds = isset($_POST['genres']) ? $_POST['genres'] : [];
            $actorIds = isset($_POST['actors']) ? $_POST['actors'] : [];
            $editionIds = isset($_POST['editions']) ? $_POST['editions'] : [];

            // Call the addMovie method to insert data into the database
            $result = $this->movieHandler->addMovie($title, $synopsis, $directorId, $producerId, $genreIds, $actorIds, $editionIds);

            echo $result;
        }
    }
}
?>
