<?php

namespace Elpr\Login;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A controller for handling all requests towards login.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class LoginController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var object $login object
     * @var object $content object
     */
    private $login;
    private $content;



    /**
     * The initialize method for creating the object and create
     * content and login objects.
     *
     * @return void
     */
    public function initialize() : void
    {
        $this->login = new Login($this->app->db);
        $this->content = new \Elpr\Content\Content($this->app->db);
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object as page
     */
    public function indexAction() : object
    {
        $title = "Login";
        $user = $this->app->session->get("username", null);
        if ($user === null) {
            $this->app->page->add("login/index");

            return $this->app->page->render([
                "title" => $title,
            ]);
        }

        return $this->app->response->redirect("login/profile");
    }

    /**
     * Admin get action
     *
     *
     * @return object AS page or redirect
     */
    public function adminActionGet() : object
    {
        $role = $this->app->session->get("role", null);
        if ($role !== "admin") {
            $this->app->response->redirect("login");
        }
        $this->app->page->add("login/admin");
        return $this->app->page->render();
    }

    /**
     * User get action
     *
     *
     * @return object AS page or redirect
     */
    public function usersActionGet() : object
    {
        $role = $this->app->session->get("role", null);
        if ($role !== "admin") {
            $this->app->response->redirect("login");
        }
        $users = $this->login->getAllUsers();
        $this->app->page->add("login/users", [
            "users" => $users
        ]);
        return $this->app->page->render();
    }


    /**
     * Validate Post action
     *
     *
     * @return object AS page or redirect
     */
    public function validateActionPost() : object
    {

        $user = $this->app->request->getPost("username", null);
        $pass = $this->app->request->getPost("password", null);

        if ($user != null && $pass != null) {
            // Check if username exists
            if ($this->login->exists($user)) {
                $getHash = $this->login->getHash($user);
                $role = $this->login->getUserRole($user);
                // Verify user password
                if (password_verify($pass, $getHash)) {
                    $this->app->session->set("username", $user);
                    $this->app->session->set("role", $role);
                    return $this->app->response->redirect("login/profile");
                } else {
                    // Redirect to login.php
                    $this->app->page->add("login/error", [
                        "message" => "User name or password is incorrect. :("
                    ]);
                }
            } else {
                // Redirect to login.php
                $this->app->page->add("login/error", [
                    "message" => "User name or password is incorrect. :("
                ]);
            }
        }
        return $this->app->page->render();
    }

    /**
     * Create get action
     *
     *
     * @return object AS page
     */
    public function createActionGet() : object
    {
        $this->app->page->add("login/add");
        return $this->app->page->render();
    }

    /**
     * Create post action.
     *
     *
     * @return object AS page or redirect
     */
    public function createActionPost() : object
    {

        $user = $this->app->request->getPost("username", null);
        $pass = $this->app->request->getPost("password", null);
        $image = $this->app->request->getPost("image", null);
        $email = $this->app->request->getPost("email", null);
        $name = $this->app->request->getPost("name", null);

        if ($user != null && $pass != null) {
            // Check if username exists
            if ($this->login->exists($user)) {
                // Redirect to login.php
                $this->app->page->add("login/error", [
                    "message" => "User name or password is already existing. :("
                ]);
                return $this->app->page->render("login/error");
            } else {
                $pass = password_hash($pass, PASSWORD_DEFAULT);
                $this->login->addUser($name, $pass, $user, $image, $email);
                $role = $this->login->getUserRole($user);
                $this->app->session->set("username", $user);
                $this->app->session->set("role", $role);
                return $this->app->response->redirect("login/profile");
            }
        }
    }

    /**
     * Delete action get
     *
     * @param string $username
     * @return object As page or redirect
     */
    public function deleteActionGet($username) : object
    {
        $title = "Delete user";
        $role = $this->app->session->get("role", null);
        if ($role !== "admin") {
            $this->app->response->redirect("login");
        }

        $res = $this->login->getUser($username);

        $this->app->page->add("login/delete", [
            "resultset" => $res,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * Delete post action
     *
     * @param string $username
     * @return object AS redirect
     */
    public function deleteActionPost($username) : object
    {
        $this->login->deleteUser($username);

        return $this->app->response->redirect("login/users");
    }

    /**
     * profile get action
     *
     *
     * @return object AS page
     */
    public function profileActionGet() : object
    {
        $user = $this->app->session->get("username");
        $profile = $this->login->getUser($user);
        $this->app->page->add("login/profile", [
            "user" => $profile
        ]);
        return $this->app->page->render();
    }

    /**
     * update get action
     *
     *
     * @return object AS page
     */
    public function updateActionGet() : object
    {
        $user = $this->app->session->get("username");
        $profile = $this->login->getUser($user);
        $this->app->page->add("login/update", [
            "user" => $profile
        ]);
        return $this->app->page->render();
    }


    /**
     * Update post action
     *
     *
     * @return object AS redirect
     */
    public function updateActionPost() : object
    {
        $user = $this->app->request->getPost("username", null);
        $pass = $this->app->request->getPost("password", null);
        $image = $this->app->request->getPost("image", null);
        $email = $this->app->request->getPost("email", null);
        $name = $this->app->request->getPost("name", null);

        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $this->login->changeUser($user, $pass, $name, $image, $email);
        return $this->app->response->redirect("login/profile");
    }

    /**
     * Logout get action
     *
     *
     * @return object AS redirect
     */
    public function logoutActionGet() : object
    {
        $this->app->session->delete("username");
        $this->app->session->delete("role");

        return $this->app->response->redirect("login");
    }
}
