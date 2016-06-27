<?php

namespace Bootdi;


use Bootdi\Container\Container;
use Bootdi\Bootstrap\EventProvider;

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

        $this->registerCoreContainerAliases();

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

    private function registerCoreContainerAliases()
    {
        $aliases = [
            'app' => ['Bootdi\App',],
        ];

        foreach ($aliases as $key => $aliases) {
            foreach ($aliases as $alias) {
                $this->alias($key, $alias);
            }
        }
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
            $this->make($provider)->boot($this);
        }
    }

    public function bootstrapWith(array $bootstrappers)
    {
        foreach ($bootstrappers as $bootstrapper) {
            $this->make($bootstrapper)->bootstrap($this);
        }
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