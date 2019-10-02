<?php namespace Anax\View;

?>


    <article class="news-container">
        <h1><?= e($content->title) ?></h1>
        <section class="news-home">
            <p><i>Latest update: <time datetime="<?= e($content->modified_iso8601) ?>" pubdate><?= e($content->modified) ?></time></i></p>
        </section>
        <section class="news-home">
            <?= $content->data ?>
        </section>
    </article>
