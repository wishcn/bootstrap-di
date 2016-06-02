<?php

namespace Bootdi\Container;


use Bootdi\Contracts\Container\Container as ContractsContainer;
use Bootdi\Exceptions\ContainerException;

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

    public function instance($abstract, $instance)
    {
        $this->container->offsetSet($abstract, $instance);
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