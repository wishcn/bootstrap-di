<?php

namespace Bootdi;


use Bootdi\Container\Container;
use Bootdi\Exceptions\ContainerException;
use Bootdi\Providers\EventProvider;

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

        $this->registerCoreService();

        $basePath && $this->setBasePath($basePath);
    }

    protected function registerBaseBindings()
    {
        self::setInstance($this);

        $this->instance('app', $this);
        $this->instance('container', $this->container);
    }

    private function registerCoreService()
    {
        $this->make(EventProvider::class)->bootstrap($this);
    }

    protected function setBasePath($basePath)
    {
        $this->basePath = rtrim($basePath, '\/');

        $this->setPathsInContainer();
    }

    protected function setPathsInContainer()
    {
        $this->instance('path', $this->path());
        $this->instance('path.base', $this->basePath());
        $this->instance('path.config', $this->configPath());
    }

    public function registerConfigProviders()
    {
        $providers = config("app.providers", []);
        foreach ($providers as $provider) {
            $this->make($provider)->register($this);
        }
    }

    public function bootstrapWith(array $bootstrappers)
    {
        foreach ($bootstrappers as $bootstrapper) {
            $this->make($bootstrapper)->bootstrap($this);
        }
    }

    public function instance($abstract, $instance)
    {
        $this->container->offsetSet($abstract, $instance);
    }

    /**
     * @param string $abstract
     * @param array $parameters
     * @return mixed
     * @throws ContainerException
     */
    public function make($abstract, $parameters = [])
    {
        $normalAbstract = $this->normalize($abstract);
        if ( $this->container->offsetExists($normalAbstract) ) {
            return $this->container->offsetGet($normalAbstract);
        }

        if ( !class_exists($abstract) ) {
            throw new ContainerException("Class {$abstract} does not exist");
        }

        $this->instance($normalAbstract, new $abstract($this));
        return $this->container->offsetGet($normalAbstract);
    }

    /**
     * @return string
     */
    public function basePath()
    {
        return $this->basePath;
    }

    /**
     * @return string
     */
    public function path()
    {
        return $this->basePath . DIRECTORY_SEPARATOR . 'app';
    }

    /**
     * @return string
     */
    public function configPath()
    {
        return $this->basePath . DIRECTORY_SEPARATOR . 'config';
    }
}