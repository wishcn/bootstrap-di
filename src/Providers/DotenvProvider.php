<?php

namespace Bootdi\Providers;


use Bootdi\App;
use Bootdi\Contracts\Providers\ServiceProvider;
use Dotenv\Dotenv;

class DotEnvProvider implements ServiceProvider
{

    /**
     * @param App $app
     * @return mixed
     */
    public function bootstrap(App $app)
    {
        $dotEnv = new Dotenv($app->make("path.base"));
        $dotEnv->load();
    }
}