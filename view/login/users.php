<?php
namespace Anax\View;

if (!$users) {
    return;
}
?>

<section class="products">
    <?php foreach ($users as $user) : ?>
        <div class="card">
            <img src="<?= asset($user->image) ?>">
            <h3><?= $user->username ?></h3>
            <p class="price">Namn: <?= $user->name ?></p>
            <p class="price">E-mail: <?= $user->email ?></p>
            <?php if ($user->role !== "admin") : ?>
            <p class="button_view"><a href="<?= url("login/delete/" . $user->username) ?>">Delete</a></p>
            <?php endif ?>
        </div>
    <?php endforeach; ?>
</section>
