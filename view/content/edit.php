<?php namespace Anax\View;

?>


<section class="wrap-form">
    <h2>Uppdatera</h2>
    <section class="form-container">
        <form method="post">
            <input type="hidden" name="contentId" value="<?= e($content->id) ?>"/>

            <p>
                <label>Title:<br>
                <input type="text" name="contentTitle" value="<?= e($content->title) ?>"/>
                </label>
            </p>

            <p>
                <label>Path:<br>
                <input type="text" name="contentPath" value="<?= e($content->path) ?>"/>
            </p>

            <p>
                <label>Slug:<br>
                <input type="text" name="contentSlug" value="<?= e($content->slug) ?>"/>
            </p>

            <p>
                <label>Text:<br>
                <textarea name="contentData"><?= e($content->data) ?></textarea>
             </p>

             <p>
                 <label>Type:<br>
                 <input type="text" name="contentType" value="<?= e($content->type) ?>"/>
             </p>

             <p>
                 <label>Publish:<br>
                 <input type="datetime" name="contentPublish" value="<?= e($content->published) ?>"/>
             </p>

            <p>
                <button class="buttons_input" type="submit" name="doSave"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                <button class="buttons_input" type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button>
                <button class="buttons_input" type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </p>
        </form>
    </section>
</section>
