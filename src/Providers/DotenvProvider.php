<?php

namespace Bootdi\Providers;


use Dotenv\Dotenv;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class DotEnvProvider implements ServiceProviderInterface
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
        $dotEnv = new Dotenv($pimple->offsetGet("path"));
        $dotEnv->load();
    }
}