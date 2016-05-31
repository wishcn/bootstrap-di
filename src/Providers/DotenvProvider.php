<?php

namespace Bootdi\Providers;


use Bootdi\App;
use Bootdi\Contracts\Providers\ServiceProvider;
use Dotenv\Dotenv;

class DotEnvProvider implements ServiceProvider
{

    /**
     * bootstrap service
     *
     * @param App $app
     * @return mixed
     */
    public function bootstrap(App $app)
    {
        $dotEnv = new Dotenv($app->make("path"));
        $dotEnv->load();
    }
}