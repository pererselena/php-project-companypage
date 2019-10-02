<?php namespace Anax\View;

?>
<section class="wrap-form">
    <h2>Skapa</h2>
    <section class="form-container">
        <form method="post">
            <p>
                <label>Title:<br>
                <input type="text" name="contentTitle" default="A Title"/>
                </label>
            </p>

            <p>
                <label>Path:<br>
                <input type="text" name="contentPath"/>
            </p>

            <p>
                <label>Slug:<br>
                <input type="text" name="contentSlug"/>
            </p>

            <p>
                <label>Text:<br>
                <textarea name="contentData"> </textarea>
             </p>

             <p>
                 <label>Type:<br>
                    <select class="dropdown" name="contentType">
                        <option value="news">Nyheter</option>
                        <option value="offer">Erbjudande</option>
                    </select>
             </p>

            <p>
                <button class="buttons_input" type="submit" name="doCreate"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
                <button class="buttons_input" type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button>
            </p>
        </form>
    </section>
</section>
