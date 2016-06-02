<?php

namespace Bootdi\Http;


use Bootdi\App;
use Bootdi\Providers\ConfigProvider;
use Bootdi\Providers\DotEnvProvider;
use Bootdi\Providers\LoadConfigProvider;

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
    public function handle()
    {
        $this->app->bootstrapWith([
            DotEnvProvider::class,
            ConfigProvider::class,
            LoadConfigProvider::class,
        ]);
    }
}