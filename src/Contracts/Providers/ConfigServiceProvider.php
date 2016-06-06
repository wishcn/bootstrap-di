<?php

namespace Bootdi\Contracts\Providers;


use Bootdi\App;

interface ConfigServiceProvider
{
    public function boot(App $app);

    public function register();
}