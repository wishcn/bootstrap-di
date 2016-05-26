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

    /**
     * @param \Bootdi\Contracts\Container\Container $instance
     */
    public static function setInstance($instance)
    {
        self::$instance = $instance;
    }

    /**
     * 注册容器
     */
    protected function registerContainer()
    {
        $this->container = new \Pimple\Container();
    }
}