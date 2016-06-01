<?php

class HelperTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var \Bootdi\App
     */
    private $app;

    /**
     * @var \Pimple\Container
     */
    private $container;

    public function setUp()
    {
        $this->app = new \Bootdi\App();
        $this->container = $this->app->getContainer();
    }

    public function testApp()
    {
        $this->assertEquals($this->app, app());
        $this->assertEquals($this->container, app("container"));
    }
}
