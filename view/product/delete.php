<?php namespace Anax\View;

?>
<section class="wrap-form">
    <h2>Delete</h2>
    <section class="form-container">
        <form method="post">
            <label>Id:</label><br>
            <input disabled type="text" name="id" value="<?= e($resultset->id) ?>"/>
            <br>
            <label>Namn:</label><br>
            <input disabled type="text" name="name" value="<?= e($resultset->name) ?>"/>
            <br>
            <label>Kategori:</label><br>
            <input disabled type="text" name="category" value="<?= e($resultset->category) ?>"/>
            <br>
            <label>Image:</label><br>
            <input disabled type="text" name="image" value="<?= e($resultset->image) ?>"/>
            <br>
            <p>
                <input class="buttons_input" type="submit" name="doDelete" value="Delete"><br>
            </p>
        </form>
    </section>
</section>
