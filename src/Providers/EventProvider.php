<?php

namespace Bootdi\Providers;


use Bootdi\App;
use Bootdi\Contracts\Providers\ServiceProvider;

class EventProvider implements ServiceProvider
{

    /**
     * @param App $app
     * @return mixed
     */
    public function bootstrap(App $app)
    {
    }
}