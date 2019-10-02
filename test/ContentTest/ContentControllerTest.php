<?php

namespace Elpr\Content;

use Anax\Response\ResponseUtility;
//use Anax\Page\Page;
use Anax\DI\DIMagic;
use PHPUnit\Framework\TestCase;

/**
 * Test the controller like it would be used from the router,
 * simulating the actual router paths and calling it directly.
 */
class ContentControllerTest extends TestCase
{
    private $controller;
    private $app;


    /**
     * Setup the controller, before each testcase, just like the router
     * would set it up.
     */
    protected function setUp(): void
    {
        global $di;
        // Init service container $di to contain $app as a service
        $di = new DIMagic();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $app = $di;
        $this->app = $app;
        $di->set("app", $app);

        // Create and initiate the controller
        $this->controller = new ContentController();
        $this->controller->setApp($app);
    }

    /**
     * Call the controller CreateActionGet action.
     */
    public function testCreateActionGet()
    {
        $res = $this->controller->createActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
