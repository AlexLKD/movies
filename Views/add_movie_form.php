<?php

use App\Actor;
use App\Controllers\MovieController;
use App\Director;
use App\Edition;
use App\Genre;
use App\MovieHandler;
use App\Producer;

$movieController = new MovieController;
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
?>

<h2>Add Movie</h2>

<form action="" method="post" class="flex-container">
    <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br>

        <label for="synopsis">Synopsis:</label>
        <textarea id="synopsis" name="synopsis" required></textarea><br>
        <input type="submit" value="Add Movie">
    </div>

    <div class="scroll-box">
        <label for="directors">Director(s):</label><br>
        <?php foreach ($directors as $director) : ?>
            <input type="checkbox" id="director<?= $director['id_director'] ?>" name="directors[]" value="<?= $director['id_director'] ?>">
            <label for="director<?= $director['id_director'] ?>">
                <?= $director['first_name'] ?> <?= $director['last_name'] ?>
            </label><br>
        <?php endforeach; ?>
    </div>

    <div class="scroll-box">
        <label for="producers">Producer(s):</label><br>
        <?php foreach ($producers as $producer) : ?>
            <input type="checkbox" id="producer<?= $producer['id_producer'] ?>" name="producers[]" value="<?= $producer['id_producer'] ?>">
            <label for="producer<?= $producer['id_producer'] ?>">
                <?= $producer['name'] ?>
            </label><br>
        <?php endforeach; ?>
    </div>

    <div class="scroll-box">
        <label for="genres">Genre(s):</label><br>
        <?php foreach ($genres as $genre) : ?>
            <input type="checkbox" id="genre<?= $genre['id_genre'] ?>" name="genres[]" value="<?= $genre['id_genre'] ?>">
            <label for="genre<?= $genre['id_genre'] ?>">
                <?= $genre['name'] ?>
            </label><br>
        <?php endforeach; ?>
    </div>

    <div class="scroll-box">
        <label for="actors">Actor(s):</label><br>
        <?php foreach ($actors as $actor) : ?>
            <input type="checkbox" id="actor<?= $actor['id_actor'] ?>" name="actors[]" value="<?= $actor['id_actor'] ?>">
            <label for="actor<?= $actor['id_actor'] ?>">
                <?= $actor['first_name'] ?> <?= $actor['last_name'] ?>
            </label><br>
        <?php endforeach; ?>
    </div>

    <div class="scroll-box">
        <label for="editions">Edition(s):</label><br>
        <?php foreach ($editions as $edition) : ?>
            <input type="checkbox" id="edition<?= $edition['id_edition'] ?>" name="editions[]" value="<?= $edition['id_edition'] ?>">
            <label for="edition<?= $edition['id_edition'] ?>">
                <?= $edition['type'] ?>
            </label><br>
        <?php endforeach; ?>
    </div>
</form>

</body>
</html>
