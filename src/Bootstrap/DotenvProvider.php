<?php

namespace Bootdi\Bootstrap;


use Bootdi\App;
use Bootdi\Providers\BaseServiceProvider;
use Dotenv\Dotenv;

class DotEnvProvider extends BaseServiceProvider
{

    public function bootstrap(App $app)
    {
        $dotEnv = new Dotenv($app->basePath());
        
        file_exists($app->basePath().DIRECTORY_SEPARATOR.".env")
        && $dotEnv->load();
    }
}