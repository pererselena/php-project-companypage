<?php namespace Anax\View;

?>
<section class="wrap-form">
    <h2>Delete</h2>
    <section class="form-container">
        <form method="post">
            <input type="hidden" type="text" name="contentId" value="<?= e($content->id) ?>"/>

            <p>
                <label>Title:<br>
                    <input type="text" name="contentTitle" value="<?= e($content->title) ?>" readonly/>
                </label>
            </p>

            <p>
                <button class="buttons_input" type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </p>
        </form>
    </section>
</section>
