<?php
namespace App\Controllers;

use App\Movie;
use App\MovieHandler;
use Exception;

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
        // Check if the form button with the name "addMovie" is clicked
        if (isset($_POST['action']) && $_POST['action'] === 'addMovie') {
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

    public function showGenresAction()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['showGenres'])) {
                $selectedMovieId = $_POST['selectedMovie'];
                $movieHandler = new MovieHandler();
                $movie = new Movie();
                $selectedMovieTitle = $movie->getMovieTitleById($selectedMovieId); // Add this method to your MovieHandler class
                $currentGenres = $movieHandler->getGenresForMovie($selectedMovieId);
                $otherGenres = $movieHandler->getOtherGenresForMovie($selectedMovieId);
                // Include the file to display genres
                include 'Views/display_genres.php';
            }
        } catch (Exception $e) {
            // Handle exceptions, e.g., display an error message
            echo 'Error: ' . $e->getMessage();
        }
    }


}
?>
