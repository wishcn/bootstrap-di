<?php

namespace Bootdi\Bootstrap;


use Bootdi\App;
use Bootdi\Providers\BaseServiceProvider;

class LoadConfigProvider extends BaseServiceProvider
{
    
    public function bootstrap(App $app)
    {
        $app->registerConfigProviders();
    }
}