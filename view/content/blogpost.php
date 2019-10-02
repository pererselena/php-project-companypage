<?php namespace Anax\View;

?>

<article class="blog-index article blog-post">
    <header>
        <h1><?= e($content->title) ?></h1>
        <p><i>Published: <time datetime="<?= e($content->published_iso8601) ?>" pubdate><?= e($content->published) ?></time></i></p>
    </header>
    <p><?= $content->data ?></p>
</article>
