<?php
namespace Anax\View;

if (!$resultset) {
    return;
}
?>

<article>

<?php foreach ($resultset as $row) : ?>
<section class="blog-index article blog-post">
    <header>
        <h1><a href="<?= url("content/blog/" . e($row->slug)) ?>"><?= e($row->title) ?></a></h1>
        <p><i>Published: <time datetime="<?= e($row->published_iso8601) ?>" pubdate><?= e($row->published) ?></time></i></p>
    </header>
    <p><?= $row->data ?></p>
    <p class="readmore"><a href="<?= url("content/blog/" . e($row->slug)) ?>">Läs mer >></a></p>
</section>
<?php endforeach; ?>

</article>
