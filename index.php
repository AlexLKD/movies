<?php

require_once 'App/Actor.php';
require_once 'includes/Database.php';

// print("Hello World");

$actor = new Actor();
$allActors = $actor->getAllActors();

// Display All Actors
echo "<h3>All Actors:</h3>";
echo "<ul>";
foreach ($allActors as $actor) {
    echo "<li>{$actor['first_name']} {$actor['last_name']}</li>";
}
echo "</ul>";

// $query = $dbCo->prepare("SELECT first_name, last_name FROM actor");
// $query->execute();
// $actors = $query->fetchAll();

// foreach($actors as $actor) {
//     echo '<p>' . $actor['first_name'] . ' ' . $actor['last_name'] . '</p>';
// }
