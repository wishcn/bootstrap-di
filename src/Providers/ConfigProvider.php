<?php

namespace Bootdi\Providers;


use Bootdi\App;
use Bootdi\Contracts\Providers\ServiceProvider;
use Config\Loader\FileLoader;
use Config\Repository;

class ConfigProvider implements ServiceProvider
{

    /**
     * bootstrap service
     *
     * @param App $app
     * @return mixed
     */
    public function bootstrap(App $app)
    {
        $conf = new Repository(new FileLoader($app->make("path.config")), "");
        $app->instance("config", $conf);

        date_default_timezone_set($conf->get("app.timezone"));

        mb_internal_encoding('UTF-8');
    }
}