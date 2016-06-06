<?php

namespace Bootdi\Boostrap;


use Bootdi\App;
use Bootdi\Providers\BaseConfigServiceProvider;

class TestConfigProvider extends BaseConfigServiceProvider
{

    /**
     * @param \Bootdi\App $app
     * @return mixed
     */
    public function register(App $app)
    {
        assert("is_int(10)");
    }
}