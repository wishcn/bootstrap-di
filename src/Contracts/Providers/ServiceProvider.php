<?php

namespace Bootdi\Contracts\Providers;


use Bootdi\App;

interface ServiceProvider
{
    /**
     * bootstrap service
     *
     * @param App $app
     * @return mixed
     */
    public function bootstrap(App $app);
}