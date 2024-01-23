<?php

use App\Actor;
use App\Director;
use App\Edition;
use App\Genre;
use App\MovieHandler;
use App\Producer;

require_once 'includes/config.php';

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


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $synopsis = $_POST['synopsis'];
    $directorId = $_POST['director'];
    $producerId = $_POST['producer'];
    $genreIds = isset($_POST['genres']) ? $_POST['genres'] : [];
    $actorIds = isset($_POST['actors']) ? $_POST['actors'] : [];
    $editionIds = isset($_POST['editions']) ? $_POST['editions'] : [];

    // Call the addMovie method to insert data into the database
    $result = $movieHandler->addMovie($title, $synopsis, $directorId, $producerId, $genreIds, $actorIds, $editionIds);

    echo $result;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movie Form</title>
</head>
<body>

<h2>Add Movie</h2>

<form action="" method="post">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required><br>

    <label for="synopsis">Synopsis:</label>
    <textarea id="synopsis" name="synopsis" required></textarea><br>

    <label for="director">Director:</label>
    <select id="director" name="director" required>
        <?php foreach ($directors as $director) : ?>
            <option value="<?= $director['id_director'] ?>"><?= $director['first_name'] ?> <?= $director['last_name'] ?></option>
        <?php endforeach; ?>
    </select><br>

    <label for="producer">Producer:</label>
    <select id="producer" name="producer" required>
        <?php foreach ($producers as $producer) : ?>
            <option value="<?= $producer['id_producer'] ?>"><?= $producer['name'] ?></option>
        <?php endforeach; ?>
    </select><br>

    <label for="genres">Genres (select multiple):</label>
    <select id="genres" name="genres[]" multiple required>
        <?php foreach ($genres as $genre) : ?>
            <option value="<?= $genre['id_genre'] ?>"><?= $genre['name'] ?></option>
        <?php endforeach; ?>
    </select><br>

    <label for="actors">Actors (select multiple):</label>
    <select id="actors" name="actors[]" multiple required>
        <?php foreach ($actors as $actor) : ?>
            <option value="<?= $actor['id_actor'] ?>"><?= $actor['first_name'] ?> <?= $actor['last_name'] ?></option>
        <?php endforeach; ?>
    </select><br>

    <label for="editions">Editions (select multiple):</label>
    <select id="editions" name="editions[]" multiple required>
        <?php foreach ($editions as $edition) : ?>
            <option value="<?= $edition['id_edition'] ?>"><?= $edition['type'] ?></option>
        <?php endforeach; ?>
    </select><br>

    <input type="submit" value="Add Movie">
</form>

</body>
</html>
