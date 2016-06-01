<?php

namespace Bootdi\Contracts\Providers;


use Bootdi\App;

interface ConfigServiceProvider
{
    /**
     * config service provider register
     *
     * @param App $app
     * @return mixed
     */
    public function register(App $app);
}