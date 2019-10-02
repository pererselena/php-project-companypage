<?php
/**
 * Base controler handling all default requests.
 */

namespace Elpr\Base;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A controller to handle request to Om and Home pages.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class BaseController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var object $base Object
     * @var object $products Object
     */
    private $base;
    private $products;



    /**
     * The initialize method to initialize the object and create two objects.
     *
     * @return void
     */
    public function initialize() : void
    {
        $this->base = new \Elpr\Content\Content($this->app->db);
        $this->products = new \Elpr\Product\Product($this->app->db);
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
        $title = "Hem";
        $base = $this->base->pageGetContent("hem");
        $news = $this->base->getLatest("news");
        $offer = $this->base->getLatest("offer");
        $product = $this->products->getLatestProduct();
        $recommended = $this->products->getRecommendedProduct();

        $this->app->page->add("content/page", [
            "content" => $base,
            "product" => $product,
            "news" => $news,
            "offer" => $offer,
            "recommended" => $recommended
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * This is the Om method action, it handles:
     * mountpoint/om
     *
     * @return object as page
     */
    public function omAction() : object
    {
        $title = "Om";
        $base = $this->base->pageGetContent("om");

        $this->app->page->add("content/om", [
            "content" => $base,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }
}
