<?php

namespace Bootdi\Container;


use Bootdi\Contracts\Container\Container as ContractsContainer;

abstract class Container implements ContractsContainer
{
    /**
     * @var static
     */
    protected static $instance;

    /**
     * @var \Pimple\Container
     */
    protected $container;

    /**
     * @return \Bootdi\Contracts\Container\Container
     */
    public static function getInstance()
    {
        return self::$instance;
    }

    public static function setInstance($instance)
    {
        self::$instance = $instance;
    }

    /**
     * @return \Pimple\Container
     */
    public function getContainer()
    {
        return $this->container;
    }
    
    protected function registerContainer()
    {
        $this->container = new \Pimple\Container();
    }

    protected function normalize($service)
    {
        return is_string($service) ? ltrim($service, '\\') : $service;
    }
}