<?php

namespace Bootdi\Contracts\Providers;


use Bootdi\App;

interface ConfigServiceProvider
{
    public function register(App $app);
}