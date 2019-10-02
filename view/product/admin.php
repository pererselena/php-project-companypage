<?php
namespace Anax\View;

if (!$resultset) {
    return;
}
?>
<section class="wrap-form">
    <h2>Administrera produkter</h2>
    <table>
        <tr class="first">
            <th>Id</th>
            <th>Namn</th>
            <th>Kategori</th>
            <th>Actions</th>
        </tr>
    <?php $id = -1; foreach ($resultset as $row) :
        $id++; ?>
        <tr>
            <td><?= $row->id ?></td>
            <td><?= $row->name ?></td>
            <td><?= $row->category ?></td>
            <td>
                <a class="icons" href="<?= url("product/update/$row->id")  ?>" title="Edit this content">
                    <i class="fas fa-edit"></i>
                </a>
                <a class="icons" href="<?= url("product/delete/$row->id")  ?>" title="Delete this content">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
    <p class="buttons_input"><a href="<?=  url("product/create") ?>">Skapa produkt</a></p>
</section>
