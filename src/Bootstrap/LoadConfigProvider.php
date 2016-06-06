<?php

namespace Bootdi\Boostrap;


use Bootdi\App;
use Bootdi\Providers\BaseServiceProvider;

class LoadConfigProvider extends BaseServiceProvider
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