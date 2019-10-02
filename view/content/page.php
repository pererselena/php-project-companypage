<?php namespace Anax\View;

?>


    <article class="home-about">
        <section class="home-heading">
            <h2><?= e($content->title) ?></h2>
            <p><i>Latest update: <time datetime="<?= e($content->modified_iso8601) ?>" pubdate><?= e($content->modified) ?></time></i></p>
        </section>
        <section class="home-content">
            <?= $content->data ?>
        </section>
    </article>
    <article class="news-container">
    <h2>Nyheter</h2>
    <?php foreach ($news as $row) : ?>
    <section class="news-home">
        <header>
            <h3><a href="<?= url("content/blog/" . e($row->slug)) ?>"><?= e($row->title) ?></a></h3>
            <p><i>Published: <time datetime="<?= e($row->published_iso8601) ?>" pubdate><?= e($row->published) ?></time></i></p>
        </header>
        <p><?= $row->data ?></p>
        <p class="readmore"><a href="<?= url("content/blog/" . e($row->slug)) ?>">Läs mer >></a></p>
    </section>
    <?php endforeach; ?>

    </article>
    <section class="recommended">
        <h2>Rekommenderade produkter</h2>
        <section class="card-container home-content">
            <?php $id = -1; foreach ($recommended as $row) :
                $id++; ?>
                <div class="card-rec">
                    <img src="<?= asset($row->image . "?w=240&h=240&crop-to-fit") ?>">
                    <div class="text-container">
                        <div class="text">
                            <h3><?= $row->name ?></h3>
                            <p>Kategori: <?= $row->category ?></p>
                            <p><a href="<?= url("product/product/" . $row->id) ?>">Visa mer</a></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    </section>
    <article class="offer-container">
        <section class="home-heading">
            <h2>Erbjudande</h2>
        </section>
        <section class="home-content">
            <?php foreach ($offer as $row) : ?>
            <header>
                <h3><a href="<?= url("content/blog/" . e($row->slug)) ?>"><?= e($row->title) ?></a></h3>
                <p><i>Published: <time datetime="<?= e($row->published_iso8601) ?>" pubdate><?= e($row->published) ?></time></i></p>
            </header>
            <p><?= $row->data ?></p>
            <p class="readmore"><a href="<?= url("content/blog/" . e($row->slug)) ?>">Läs mer >></a></p>
            <?php endforeach; ?>
        </section>
    </article>
    <section class="latest">
        <section class="card-container home-content">
            <?php $id = -1; foreach ($product as $row) :
                $id++; ?>
                <div class="card-rec">
                    <img src="<?= asset($row->image . "?w=240&h=240&crop-to-fit") ?>">
                    <div class="text-container">
                        <div class="text">
                            <h3><?= $row->name ?></h3>
                            <p>Kategori: <?= $row->category ?></p>
                            <p><a href="<?= url("product/product/" . $row->id) ?>">Visa mer</a></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
        <section class="home-heading">
            <h2>Senaste produkterna</h2>
        </section>
    </section>
