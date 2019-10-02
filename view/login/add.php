<?php
namespace Anax\View;

?>

<section class="wrap-form">
    <h2>Skapa</h2>
    <section class="form-container">
        <form action="create" method="POST">
            <table>
                <legend><h3>Create user</h3></legend>
                <tr>
                    <td>Enter name:</td><td><input type="text" name="name"></td>
                </tr>
                <tr>
                    <td>Enter username:</td><td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td>Enter e-mail:</td><td><input type="email" name="email"></td>
                </tr>
                <tr>
                    <td>Enter image:</td><td><input type="text" name="image"></td>
                </tr>
                <tr>
                    <td>Choose pass:</td><td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td><input class="buttons_input" type="submit" name="submitCreateForm" value="Registrera"></td>
                </tr>
            </table>
        </form>
    </section>
</section>
