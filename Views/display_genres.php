<?php if (isset($currentGenres) && isset($otherGenres)) : ?>
<h2 class="ttl">Genres for Movie: <?php echo $selectedMovieTitle; ?></h2>

<!-- Display current genres for the selected movie -->
<div class="genre-lists">
<?php if (isset($currentGenres)) : ?>
    <div class="current-genres">
    <h3>Genres actuels :</h3>
    <ul>
        <?php foreach ($currentGenres as $genre) : ?>
            <li>
                <input type="checkbox" name="currentGenres[]" id="currentGenre<?= $genre['id_genre'] ?>" value="<?= $genre['id_genre'] ?>" checked>
                <label for="currentGenre<?= $genre['id_genre'] ?>"><?= $genre['name'] ?></label>
            </li>
        <?php endforeach; ?>
    </ul>
    </div>
<?php endif; ?>

<!-- Display other genres for the selected movie -->
<?php if (isset($otherGenres)) : ?>
    <div class="other-genres">
    <h3>Autres genres :</h3>
    <ul>
        <?php foreach ($otherGenres as $genre) : ?>
            <li>
                <input type="checkbox" name="otherGenres[]" id="otherGenre<?= $genre['id_genre'] ?>" value="<?= $genre['id_genre'] ?>">
                <label for="otherGenre<?= $genre['id_genre'] ?>"><?= $genre['name'] ?></label>
            </li>
        <?php endforeach; ?>
    </ul>
    </div>
<?php endif; ?>
</div>
<?php endif; ?>