<?php

class AppTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var \Bootdi\App
     */
    private $app;

    /**
     * @var \Pimple\Container
     */
    private $container;

    /**
     * @var string
     */
    private $rootPath;

    public function setUp()
    {
        $this->rootPath = realpath(__DIR__ . "/../");

        $this->app = new \Bootdi\App($this->rootPath);
        $this->container = $this->app->getContainer();
    }

    public function testProvider()
    {
        $this->app->make(\Bootdi\Http\Kernel::class)->start();

        $this->assertNotNull($this->app->make("config"));
    }

    public function testConfigProvider()
    {
        $this->app->make(\Bootdi\Http\Kernel::class)->start();

        $this->assertNull(config("app.providers"));
        $this->assertTrue(config("app.debug"));
    }

    public function testDi()
    {
        $this->assertEquals($this->app, $this->app->getInstance());
    }

    public function testContainer()
    {
        $this->assertEquals($this->app, $this->app->make('app'));
        $this->assertEquals($this->container, $this->app->make('container'));
    }

    public function testMake()
    {
        $this->assertEquals($this->app, $this->app->make("app"));
        $this->assertEquals($this->container, $this->app->make("container"));
    }

    public function testPath()
    {
        $this->assertEquals($this->rootPath, $this->app->basePath());
        $this->assertEquals($this->rootPath . DIRECTORY_SEPARATOR . "app", $this->app->path());
        $this->assertEquals($this->rootPath . DIRECTORY_SEPARATOR . "config", $this->app->configPath());
    }

}
