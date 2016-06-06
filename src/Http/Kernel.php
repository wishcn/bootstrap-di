<?php

namespace Bootdi\Http;


use Bootdi\App;
use Bootdi\Boostrap\ConfigProvider;
use Bootdi\Boostrap\DotEnvProvider;
use Bootdi\Boostrap\LoadConfigProvider;

class Kernel implements \Bootdi\Contracts\Http\Kernel
{
    /**
     * @var App
     */
    protected $app;

    public function __construct()
    {
        $this->app = app();
    }

    /**
     * @return mixed
     */
    public function bootstrap()
    {
        $this->app->bootstrapWith([
            DotEnvProvider::class,
            ConfigProvider::class,
            LoadConfigProvider::class,
        ]);
    }
}