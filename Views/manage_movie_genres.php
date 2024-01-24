<?php
use App\Controllers\MovieController;
use App\Genre;
use App\Movie;
use App\MovieHandler;

$movie = new Movie();
$movieController = new MovieController();
$movieHandler = new MovieHandler();

// Fetch all movies
$movies = $movie->getAllMovies();
?>

<h2 class="ttl">Gérer les genres</h2>

<form class="genre-form" action="index.php" method="post">

    <label for="selectedMovie">Sélectionnez un film :</label>
    <select name="selectedMovie" id="selectedMovie" required>
        <?php foreach ($movies as $movie) : ?>
            <option value="<?= $movie['id_movie'] ?>"><?= $movie['title'] ?></option>
        <?php endforeach; ?>
    </select>

    <!-- Changer le type du bouton pour soumettre le formulaire -->
    <button type="submit" name="showGenres" value="showGenres">Afficher les genres</button>
</form>

<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['showGenres'])) {
    $movieController->showGenresAction();
}
?>