<?php

namespace Bootdi\Bootstrap;


use Bootdi\App;
use Bootdi\Providers\BaseConfigServiceProvider;

class TestConfigProvider extends BaseConfigServiceProvider
{

    public function boot(App $app)
    {
        assert("is_int(10)");
    }
}