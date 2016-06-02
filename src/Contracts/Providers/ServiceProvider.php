<?php

namespace Bootdi\Contracts\Providers;


use Bootdi\App;

interface ServiceProvider
{
    /**
     * @param \Bootdi\App $app
     * @return mixed
     */
    public function bootstrap(App $app);
}