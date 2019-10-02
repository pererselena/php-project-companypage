<?php namespace Anax\View;

?>
<section class="wrap-form">
    <h2>Skapa</h2>
    <section class="form-container">
        <form method="post">
            <label>Namn:</label><br>
            <input type="text" name="name"/>
            <br>
            <label>Beskrivning:</label><br>
            <input type="text" name="description"/>
            <br>
            <label>Image:</label><br>
            <input type="text" name="image"/>
            <br>
            <label>Kategori:</label><br>
            <input type="text" name="category"/>
            <br>
            <label>Profil:</label><br>
            <input type="text" name="profile"/>
            <br>
            <label>Solskydd:</label><br>
            <input type="text" name="sunscreen"/>
            <br>
            <label>Alternativ:</label><br>
            <input type="text" name="options"/>
            <br>
            <label>Rekommenderat:</label><br>
            <select class="dropdown">
                <option value="yes">Ja</option>
                <option value="no">Inte idag</option>
            </select>
            <p>
                <input class="buttons_input" type="submit" name="doAdd" value="Add"><br>
            </p>
        </form>
    </section>
</section>
