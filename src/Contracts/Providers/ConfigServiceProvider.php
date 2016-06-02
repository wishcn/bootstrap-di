<?php

namespace Bootdi\Contracts\Providers;


use Bootdi\App;

interface ConfigServiceProvider
{
    /**
     * @param \Bootdi\App $app
     * @return mixed
     */
    public function register(App $app);
}