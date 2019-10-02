<?php namespace Anax\View;

?>
<section class="wrap-form">
    <h2>Uppdatera</h2>
    <section class="form-container">
        <form method="post">
            <input type="hidden" name="id" value="<?= e($resultset->id) ?>"/>
            <br>

            <label>Namn:</label><br>
            <input type="text" name="name" value="<?= e($resultset->name) ?>"/>
            <br>


            <label>Beskrivninig:</label><br>
            <input type="text" name="description" value="<?= e($resultset->description) ?>"/>
            <br>


            <label>Image:</label><br>
            <input type="text" name="image" value="<?= e($resultset->image) ?>"/>
            <br>

            <label>Kategory:</label><br>
            <input type="text" name="category" value="<?= e($resultset->category) ?>"/>
            <br>

            <label>Profil:</label><br>
            <input type="text" name="profile" value="<?= e($resultset->profile) ?>"/>
            <br>

            <label>Solskydd:</label><br>
            <input type="text" name="sunscreen" value="<?= e($resultset->sunscreen) ?>"/>
            <br>

            <label>Alternativ:</label><br>
            <input type="text" name="options" value="<?= e($resultset->options) ?>"/>
            <br>

            <label>Rekommenderat:</label><br>
            <select class="dropdown" name="recommended" value="<?= e($resultset->recommended) ?>">
                <option value="yes">Ja</option>
                <option value="no">Inte idag</option>
            </select>
            <br>


            <p>
                <input class="buttons_input" type="submit" name="doSave" value="Save">
            </p>
            <br>
        </form>
    </section>
</section>
