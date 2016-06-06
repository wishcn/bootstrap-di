<?php

namespace Bootdi\Boostrap;


use Bootdi\App;
use Bootdi\Providers\BaseServiceProvider;
use Evenement\EventEmitter;

class EventProvider extends BaseServiceProvider
{

    /**
     * @param \Bootdi\App $app
     * @return mixed
     */
    public function bootstrap(App $app)
    {
        $emitter = new EventEmitter();
        $app->instance('events', $emitter);
    }
}