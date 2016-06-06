<?php

namespace Bootdi\Boostrap;


use Bootdi\App;
use Bootdi\Contracts\Providers\ServiceProvider;
use Dotenv\Dotenv;

class DotEnvProvider implements ServiceProvider
{

    /**
     * @param \Bootdi\App $app
     * @return mixed
     */
    public function bootstrap(App $app)
    {
        $dotEnv = new Dotenv($app->basePath());
        
        file_exists($app->basePath().DIRECTORY_SEPARATOR.".env")
        && $dotEnv->load();
    }
}