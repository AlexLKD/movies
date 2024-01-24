<?php
use App\Controllers\MovieController;
use App\Genre;
use App\Movie;
use App\MovieHandler;

$movieController = new MovieController();
$movieHandler = new MovieHandler();

?>
<h2 class="ttl">Manage Genres</h2>

<form class="genre-form" action="process_form.php" method="post">
    <label for="selectedMovie">Select a movie:</label>
    <select name="selectedMovie" id="selectedMovie" required>
        <?php foreach ($movies as $movie) : ?>
            <option value="<?= $movie['id_movie'] ?>"><?= $movie['title'] ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit" name="action" value="showGenres">Show Genres</button>
</form>