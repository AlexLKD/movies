<!-- Display current genres for the selected movie -->
<?php if (isset($currentGenres)) : ?>
    <h3>Genres actuels :</h3>
    <select name="currentGenres" id="currentGenres" multiple>
        <?php foreach ($currentGenres as $genre) : ?>
            <option value="<?= $genre['id_genre'] ?>"><?= $genre['name'] ?></option>
        <?php endforeach; ?>
    </select>
<?php endif; ?>

<!-- Display other genres for the selected movie -->
<?php if (isset($otherGenres)) : ?>
    <h3>Autres genres :</h3>
    <select name="otherGenres" id="otherGenres" multiple>
        <?php foreach ($otherGenres as $genre) : ?>
            <option value="<?= $genre['id_genre'] ?>"><?= $genre['name'] ?></option>
        <?php endforeach; ?>
    </select>
<?php endif; ?>
