<?php
namespace Anax\View;

if (!$resultset) {
    return;
}
?>
<section class="offer">
    <h1>Nuvarande erbjudande!</h1>
    <ul class="offer-list">
    <?php foreach ($offer as $row) : ?>
        <li><a href="<?= url("content/blog/" . e($row->slug)) ?>"><?= e($row->title) ?> >></a></li>
    <?php endforeach; ?>
    </ul>
    <hr>
</section>

<section class="wrap">
    <h1>Produkter</h1>
    <form action="product/searchproduct" class="search" method="post">
        <input class="searchTerm" type="text" name="searchProduct" placeholder="Söka produkt" value="<?= htmlentities($searchProduct) ?>"/>
        <input class="searchButton" type="submit" name="doSearch" value="Search">
    </form>
</section>

<section class="products">
    <?php $id = -1; foreach ($resultset as $row) :
        $id++; ?>
        <div class="card">
            <img src="<?= asset($row->image) . "?w=340&h=280&crop-to-fit" ?>">
                <h3><?= $row->name ?></h3>
                <p class="items price">Artikelnummer: <?= $row->id ?></p>
                <p class="items price">Kategori: <?= $row->category ?></p>
                <?= $row->description ?>
                <p class="button_view"><a href="<?= url("product/product/" . $row->id) ?>">Visa mer</a></p>
        </div>
    <?php endforeach; ?>
</section>
