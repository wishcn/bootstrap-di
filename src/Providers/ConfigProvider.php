<?php

namespace Bootdi\Providers;


use Noodlehaus\Config;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ConfigProvider implements ServiceProviderInterface
{

    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        $conf = new Config($pimple->offsetGet("path.config"));
        $pimple->offsetSet("config", $conf);
    }
}