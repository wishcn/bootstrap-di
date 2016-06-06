<?php

namespace Bootdi\Boostrap;


use Bootdi\App;
use Bootdi\Contracts\Providers\ServiceProvider;

class LoadConfigProvider implements ServiceProvider
{

    /**
     * @param \Bootdi\App $app
     * @return mixed
     */
    public function bootstrap(App $app)
    {
        $app->registerConfigProviders();
    }
}