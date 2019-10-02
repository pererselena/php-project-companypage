<?php namespace Anax\View;

?>
<section class="wrap-form">
    <h1>Updatera profil</h1>
    <section class="form-container">
        <form method="post">
            <input type="hidden" name="username" value="<?= e($user->username) ?>"/>
            <br>

            <label>Namn:</label><br>
            <input type="text" name="name" value="<?= e($user->name) ?>"/>
            <br>

            <label>Image:</label><br>
            <input type="text" name="image" value="<?= e($user->image) ?>"/>
            <br>

            <label>E-mail:</label><br>
            <input type="email" name="email" value="<?= e($user->email) ?>"/>
            <br>

            <label>Lösenord:</label><br>
            <input type="password" name="profile"/>
            <br>

            <p>
                <input type="submit" name="doSave" value="Spara">
            </p>
            <br>
        </form>
    </section>
</section>
