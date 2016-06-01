<?php

namespace Bootdi\Contracts\Http;


interface Kernel
{
    public function handle();
    public function start();
}