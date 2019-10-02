<?php
namespace Anax\View;

if (!$resultset) {
    return;
}
?>
<section class="wrap-form">
    <h2>Administrera content</h2>
    <table>
        <tr class="first">
            <th>Id</th>
            <th>Title</th>
            <th>Type</th>
            <th>Published</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Deleted</th>
            <th>Actions</th>
        </tr>
    <?php $id = -1; foreach ($resultset as $row) :
        $id++; ?>
        <tr>
            <td><?= $row->id ?></td>
            <td><?= $row->title ?></td>
            <td><?= $row->type ?></td>
            <td><?= $row->published ?></td>
            <td><?= $row->created ?></td>
            <td><?= $row->updated ?></td>
            <td><?= $row->deleted ?></td>
            <td>
                <a class="icons" href="edit/<?= $row->id ?>" title="Edit this content">
                    <i class="fas fa-edit"></i>
                </a>
                <a class="icons" href="delete/<?= $row->id ?>" title="Delete this content">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
    <p class="buttons_input"><a href="<?=  url("content/create") ?>">Skapa content</a></p>
</section>
