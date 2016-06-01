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

        $basePath && $this->setBasePath($basePath);
    }

    /**
     * set bindings
     */
    protected function registerBaseBindings()
    {
        self::setInstance($this);

        $this->instance('app', $this);
        $this->instance('container', $this->container);
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
        $this->instance('path', $this->path());
        $this->instance('path.base', $this->basePath());
        $this->instance('path.config', $this->configPath());
    }

    /**
     * register config providers
     *
     */
    public function registerConfigProviders()
    {
        $providers = config("app.providers", []);
        foreach ($providers as $provider) {
            $this->make($provider)->register($this);
        }
    }

    /**
     * init bootstrap
     *
     * @param array $bootstrappers
     */
    public function bootstrapWith(array $bootstrappers)
    {
        foreach ($bootstrappers as $bootstrapper) {
            $this->make($bootstrapper)->bootstrap($this);
        }
    }

    /**
     * instance object
     *
     * @param $abstract
     * @param $instance
     */
    public function instance($abstract, $instance)
    {
        $this->container->offsetSet($abstract, $instance);
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
        $normalAbstract = $this->normalize($abstract);
        if ( $this->container->offsetExists($normalAbstract) ) {
            return $this->container->offsetGet($normalAbstract);
        }

        $this->instance($normalAbstract, new $abstract());

        return $this->container->offsetGet($normalAbstract);
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