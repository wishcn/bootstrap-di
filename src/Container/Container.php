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
     * @var array
     */
    protected $alias;

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

    protected function getAlias($alias)
    {
        return isset($this->alias[$alias]) ? $this->alias[$alias] : $alias;
    }

    protected function alias($abstract, $alias)
    {
        $this->alias[$alias] = $this->normalize($abstract);
    }

    /**
     * @param string $abstract
     * @param array $parameters
     * @return mixed
     * @throws ContainerException
     */
    public function make($abstract, $parameters = [])
    {
        $abstract = $this->getAlias($abstract);

        $normalAbstract = $this->normalize($abstract);
        if ( $this->container->offsetExists($normalAbstract) ) {
            return $this->container->offsetGet($normalAbstract);
        }

        if ( !class_exists($abstract) ) {
            throw new ContainerException("Class {$abstract} does not exist");
        }

        $reflector = new \ReflectionClass($abstract);
        if (!$reflector->isInstantiable()) {
            throw new ContainerException("Can't instantiate this");
        }

        $constructor = $reflector->getConstructor();
        if (is_null($constructor)) {
            return new $abstract;
        }

        $parameters = $constructor->getParameters();
        $dependencies = $this->getDependencies($parameters);
        $builder = $reflector->newInstanceArgs($dependencies);

        $this->instance($normalAbstract, $builder);
        return $this->container->offsetGet($normalAbstract);
    }

    private function getDependencies($parameters)
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $dependency = $parameter->getClass();
            if (is_null($dependency)) {
                $dependencies[] = $this->resolveNonClass($parameter);
            } else {
                $dependencies[] = $this->make($dependency->name);
            }
        }

        return $dependencies;
    }

    private function resolveNonClass($parameter)
    {
        if ($parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }

        throw new \Exception('I have no idea what to do here');
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