<?php

namespace Bootdi\Providers;


use Bootdi\App;
use Bootdi\Contracts\Providers\ConfigServiceProvider;

abstract class BaseConfigServiceProvider implements ConfigServiceProvider
{
    /**
     * @var \Bootdi\App
     */
    protected $app;

    public function boot(App $app)
    {
        $this->app = $app;
    }

    public function register()
    {
    }
}