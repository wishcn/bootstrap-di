<?php

namespace Bootdi\Contracts\Providers;


use Bootdi\App;

interface ServiceProvider
{
    public function bootstrap(App $app);
}