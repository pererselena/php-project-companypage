<?php

namespace Elpr\Content;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

/**
 * A controller to handle request to content.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class ContentController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var object $content reference to the content
     * object to handle everything db related.
     */
    private $content;



    /**
     * The initialize will create a new object and create a content object.
     *
     * @return void
     */
    public function initialize() : void
    {
        $this->content = new Content($this->app->db);
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
        $title = "Content";
        $content = $this->content->blogContent("news");

        $this->app->page->add("content/blog", [
            "resultset" => $content,
        ]);


        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * This is the create method action, it handles:
     * ANY METHOD mountpoint/create
     *
     * @return object as page
     */
    public function createActionGet() : object
    {
        $title = "Create content | oophp";
        $role = $this->app->session->get("role", null);
        if ($role !== "admin") {
            $this->app->response->redirect("login");
        }

        $this->app->page->add("content/create");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * Create post Action.
     *
     *
     * @return object as page or redirect
     */
    public function createActionPost() : object
    {
        $title = $this->app->request->getPost("contentTitle");
        $path = $this->app->request->getPost("contentPath");
        $slug = $this->app->request->getPost("contentSlug");
        $data = $this->app->request->getPost("contentData");
        $type = $this->app->request->getPost("contentType");

        if (!$slug) {
            $slug = $this->content->slugify($title);
        }

        if (!$path) {
            $path = $slug;
        }
        $params = [$title, $path, $slug, $data, $type];

        try {
            $this->content->create($params);
        } catch (\Exception $e) {
            $this->app->page->add("content/error", [
                "message" => "Path/slug already exist :( .\n" . $e
            ]);
            return $this->app->page->render();
        }

        return $this->app->response->redirect("content/admin");
    }

    /**
     * Edit action
     *
     * @param int $id
     *
     * @return object As page
     */
    public function editActionGet($id) : object
    {
        $title = "Edit | oophp";
        $role = $this->app->session->get("role", null);
        if ($role !== "admin") {
            $this->app->response->redirect("login");
        }

        $content = $this->content->getContent($id);

        $this->app->page->add("content/edit", [
            "content" => $content,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * Edit post action
     *
     * @param int $id
     * @return object AS page or redirect
     */
    public function editActionPost($id) : object
    {
        $doDelete = $this->app->request->getPost("doDelete");
        $doSave = $this->app->request->getPost("doSave");
        if (isset($doDelete)) {
            return $this->app->response->redirect("content/delete/" . $id);
        } elseif (isset($doSave)) {
            $title = $this->app->request->getPost("contentTitle");
            $path = $this->app->request->getPost("contentPath");
            $slug = $this->app->request->getPost("contentSlug");
            $data = $this->app->request->getPost("contentData");
            $type = $this->app->request->getPost("contentType");
            $publish = $this->app->request->getPost("contentPublish");
            $id = $this->app->request->getPost("contentId");

            $params = [$title, $path, $slug, $data, $type, $publish, $id];
            try {
                $this->content->updateContent($params);
            } catch (\Exception $e) {
                $this->app->page->add("content/error", [
                    "message" => $e
                ]);
                return $this->app->page->render();
            }
        }

        return $this->app->response->redirect("content/index");
    }

    /**
     * delete action get
     *
     * @param int $id
     * @return object As page
     */
    public function deleteActionGet($id) : object
    {
        $title = "Delete | oophp";
        $role = $this->app->session->get("role", null);
        if ($role !== "admin") {
            $this->app->response->redirect("login");
        }
        if (!is_numeric($id)) {
            $this->app->page->add("content/error", [
                "message" => "Not a valid id :("
            ]);
            return $this->app->page->render();
        }
        $content = $this->content->getContent($id);

        $this->app->page->add("content/delete", [
            "content" => $content,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * Delete post action
     *
     * @param int $id
     * @return object AS redirect
     */
    public function deleteActionPost($id) : object
    {

        $doDelete = $this->app->request->getPost("doDelete");
        if (isset($doDelete)) {
            $this->content->deleteContent($id);
        }


        return $this->app->response->redirect("content/admin");
    }

    /**
     * Admin get action
     *
     *
     * @return object As page or redirect
     */
    public function adminActionGet() : object
    {
        $title = "Admin | oophp";
        $role = $this->app->session->get("role", null);
        if ($role !== "admin") {
            $this->app->response->redirect("login");
        }

        $content = $this->content->adminContent();

        $this->app->page->add("content/admin", [
            "resultset" => $content,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * Offer get action
     *
     * @param string $path
     * @return object As page
     */
    public function offerActionGet($path = null) : object
    {
        $title = "View offer";

        if ($path) {
            $content = $this->content->pageGetContent($path);
            if (!$content) {
                $title = "404";
                $this->app->page->add("content/404");
            } else {
                $title = $content->title;
                $this->app->page->add("content/offer", [
                    "content" => $content,
                ]);
            }
        } else {
            $content = $this->content->offerContent();

            $this->app->page->add("content/offer", [
                "resultset" => $content,
            ]);
        }

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * Blogg action get
     *
     * @param $path
     * @return object As page
     */
    public function blogActionGet($path = null) : object
    {
        $title = "View News";

        if ($path) {
            $content = $this->content->blogpostGetContent($path);
            if (!$content) {
                $title = "404";
                $this->app->page->add("content/404");
            } else {
                $title = $content->title;
                $this->app->page->add("content/blogpost", [
                    "content" => $content,
                ]);
            }
        } else {
            $content = $this->content->blogContent("news");

            $this->app->page->add("content/blog", [
                "resultset" => $content,
            ]);
        }

        return $this->app->page->render([
            "title" => $title,
        ]);
    }
}
