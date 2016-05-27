<?php

namespace Bootdi;


use Bootdi\Container\Container;
use Bootdi\Providers\ConfigProvider;
use Bootdi\Providers\DotEnvProvider;

class App extends Container
{
    /**
     * @var string basePath
     */
    protected $basePath;

    public function __construct($basePath = null)
    {
        $this->registerContainer();

        $this->registerBaseBindings();

        if ($basePath) {
            $this->setBasePath($basePath);
        }
    }

    /**
     * set bindings
     */
    protected function registerBaseBindings()
    {
        self::setInstance($this);

        $this->container->offsetSet('app', $this);
        $this->container->offsetSet('container', $this->container);
    }

    /**
     * register provider
     */
    protected function registerProvider()
    {
        $this->container->register(new DotEnvProvider());
        $this->container->register(new ConfigProvider());
    }

    /**
     * @param $basePath
     */
    protected function setBasePath($basePath)
    {
        $this->basePath = rtrim($basePath, '\/');

        $this->setPathsInContainer();
    }

    /**
     * set paths
     */
    protected function setPathsInContainer()
    {
        $this->container->offsetSet('path', $this->path());
        $this->container->offsetSet('path.base', $this->basePath());
        $this->container->offsetSet('path.config', $this->configPath());
    }

    /**
     * return container
     *
     * @param string $abstract
     * @param array $parameters
     * @return mixed
     */
    public function make($abstract, $parameters = [])
    {
        return $this->container->offsetGet($abstract);
    }

    /**
     * base path
     *
     * @return string
     */
    public function basePath()
    {
        return $this->basePath;
    }

    /**
     * path
     *
     * @return string
     */
    public function path()
    {
        return $this->basePath . DIRECTORY_SEPARATOR . 'app';
    }

    /**
     * config path
     */
    public function configPath()
    {
        return $this->basePath . DIRECTORY_SEPARATOR . 'config';
    }
}