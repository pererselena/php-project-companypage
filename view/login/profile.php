<?php
namespace Anax\View;

if (!$user) {
    return;
}
?>

<h2><?= $user->username ?></h2>


<section class="product-container">
    <section class="product-image">
        <img src="<?= asset($user->image) ?>">
    </section>
    <section class="product-content">
        <p>Namn: <?= $user->name ?></p>
        <p>e-mail: <?= $user->email ?></p>
    </section>
    <section class="block toc">
        <h4>Meny</h4>
        <ul class="toc">
            <li><a href="<?= url("login/update") ?>">Updatera</a></li>
            <li><a href="<?= url("login/logout") ?>">Logga ut</a></li>
        <?php
        if ($user->role === "admin") : ?>
            <li><a href="<?= url("content/admin") ?>">Administrera content</a></li>
            <li><a href="<?= url("product/admin") ?>">Administrera produkter</a></li>
            <li><a href="<?= url("login/users") ?>">Administrera användare</a></li>
        <?php endif ?>
        </ul>
    </section>
</section>
