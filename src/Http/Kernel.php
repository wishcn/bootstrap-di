<?php

namespace Bootdi\Http;


use Bootdi\Providers\ConfigProvider;
use Bootdi\Providers\DotEnvProvider;

class Kernel implements \Bootdi\Contracts\Http\Kernel
{
    protected $app;

    public function __construct()
    {
        $this->app = app();
    }

    /**
     * run kernel
     *
     * @return mixed
     */
    public function start()
    {
        $this->app->bootstrapWith([
            ConfigProvider::class,
            DotEnvProvider::class,
        ]);
    }
}