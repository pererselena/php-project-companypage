<?php
namespace Anax\View;

?>

<section class="wrap-form login">
    <h2>Logga in</h2>
    <section class="form-container">
        <form action="login/validate" method="POST">
            <table>
                <legend><h3>Login form</h3></legend>
                <tr>
                    <td>Enter username:</td><td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td>Enter pass:</td><td><input type="password" name="password"></td>
                </tr>
                <tr class="login-buttons">
                    <td><input class="buttons_input" type="submit" name="submitForm" value="Login"></td>
                    <td>
                        <p class="buttons_input">
                            <a href="<?= url("login/create") ?>">Registrera</a>
                        </p>
                    </td>
                </tr>
            </table>

        </form>

    </section>
</section>
