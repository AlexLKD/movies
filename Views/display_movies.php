<?php 
use App\Controllers\MovieController;
use App\Actor;
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


// $movieHandler = new MovieHandler();
// $movies = $movieHandler->getMovies();

// Contrôleur
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $director = isset($_GET['director']) ? $_GET['director'] : null;
    $genre = isset($_GET['genre']) ? $_GET['genre'] : null;
    $actor = isset($_GET['actor']) ? $_GET['actor'] : null;
    $movies = $movieHandler->searchMoviesWithDetails($searchTerm, $director, $genre, $actor);
}




?>

<h2 class="ttl">All Movies</h2>

<!-- Formulaire dans votre fichier HTML -->
<form action="" method="get" class="filter-form">
    <label for="search">Search a movie :</label>
    <input type="text" id="search" name="search">
    <label for="director">Director :</label>
    <select id="director" name="director">
        <option value="">All Directors</option>
        <?php foreach ($directors as $director) : ?>
            <option value="<?= $director['id_director'] ?>"><?= $director['first_name'] ?> <?= $director['last_name'] ?></option>
        <?php endforeach; ?>
    </select>
    <label for="genre">Genre :</label>
    <select id="genre" name="genre">
        <option value="">All genres</option>
        <?php foreach ($genres as $genre) : ?>
            <option value="<?= $genre['id_genre'] ?>"><?= $genre['name'] ?></option>
        <?php endforeach; ?>
    </select>
    <label for="actor">Actor :</label>
    <select id="actor" name="actor">
        <option value="">All Actors</option>
        <?php foreach ($actors as $actor) : ?>
            <option value="<?= $actor['id_actor'] ?>"><?= $actor['first_name'] ?> <?= $actor['last_name'] ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Search</button>
</form>


<div class="movie-boxes">
<?php foreach ($movies as $movie) : ?>
    <div class="movie-box" data-movie-id="<?= $movie['id_movie'] ?>">
        <h3 class="ttl"><?= $movie['title'] ?></h3>
        <p><strong>Director:</strong> <?= $directorClass->getDirectorName($movie['director_id_director']) ?></p>
        <p ><strong>Actors:</strong> <?= $actorClass->getActorsNames($movie['id_movie']) ?></p>
        <p><strong>Genres:</strong> <?= $genreClass->getGenreNames($movie['id_movie']) ?></p>
    </div>
<?php endforeach; ?>
</div>
