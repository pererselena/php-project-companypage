<?php
namespace Anax\View;

if (!$product) {
    return;
}
?>

<h2 class="product-heading"><?= $product->name ?></h2>
    <section class="product-container">
        <section class="product-image">
            <img src="<?= asset($product->image) ?>">
        </section>
        <section class="product-content">
            <p>Artikelnummer: <?= $product->id ?></p>
            <p>Kategori: <?= $product->category ?></p>
            <p><?= $product->description ?></p>
            <p>Profil: <?= $product->profile ?></p>
            <p>Solskydd: <?= $product->sunscreen ?></p>
            <p>Alternativ: <?= $product->options ?></p>
        </section>
    </section>
