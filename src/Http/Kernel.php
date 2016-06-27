<?php

namespace Bootdi\Http;


use Bootdi\App;
use Bootdi\Bootstrap\ConfigProvider;
use Bootdi\Bootstrap\DotenvProvider;
use Bootdi\Bootstrap\LoadConfigProvider;

class Kernel implements \Bootdi\Contracts\Http\Kernel
{
    /**
     * @var App
     */
    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function bootstrap()
    {
        $this->app->bootstrapWith([
            DotenvProvider::class,
            ConfigProvider::class,
            LoadConfigProvider::class,
        ]);
    }
}