<?php

namespace Bootdi\Bootstrap;


use Bootdi\App;
use Bootdi\Providers\BaseServiceProvider;
use Evenement\EventEmitter;

class EventProvider extends BaseServiceProvider
{

    public function bootstrap(App $app)
    {
        $emitter = new EventEmitter();
        $app->instance('events', $emitter);
    }
}