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

    /**
     * @param \Bootdi\App $app
     * @return mixed
     */
    public function register(App $app)
    {
        $this->app = $app;
    }

    public function boot()
    {
    }
}