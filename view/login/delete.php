<?php namespace Anax\View;

?>
<section class="wrap-form">
    <h2>Delete</h2>
    <section class="form-container">
        <form method="post">
            <label>Username:</label><br>
            <input disabled type="text" name="username" value="<?= e($resultset->username) ?>"/>
            <br>
            <label>Namn:</label><br>
            <input disabled type="text" name="name" value="<?= e($resultset->name) ?>"/>
            <br>
            <label>E-mail:</label><br>
            <input disabled type="email" name="category" value="<?= e($resultset->email) ?>"/>
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
