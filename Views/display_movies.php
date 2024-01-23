<?php 
use App\Actor;
use App\Controllers\MovieController;
use App\Director;
use App\Edition;
use App\Genre;
use App\Movie;
use App\MovieHandler;
use App\Producer;

$movieController = new MovieController();
$movieController->addMovie();
$movieHandler = new MovieHandler();
$directorClass = new Director();
$directors = $directorClass->getAllDirectors();
$producerClass = new Producer();
$producers = $producerClass->getAllProducers();
$genreClass = new Genre();
$genres = $genreClass->getAllGenres();
$actorClass = new Actor();
$actors = $actorClass->getAllActors();
$editionClass = new Edition();
$editions = $editionClass->getAllEditions();
$movieClass = new Movie();
$movies = $movieClass->getAllMovies();


?>

<h2>All Movies</h2>
<?php foreach ($movies as $movie) : ?>
    <div class="movie-box">
        <h3><?= $movie['title'] ?></h3>
    </div>
<?php endforeach; ?>

