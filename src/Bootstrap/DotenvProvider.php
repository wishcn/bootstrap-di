<?php

namespace Bootdi\Boostrap;


use Bootdi\App;
use Dotenv\Dotenv;

class DotEnvProvider extends BaseServiceProvider
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