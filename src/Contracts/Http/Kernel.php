<?php

namespace Bootdi\Contracts\Http;


interface Kernel
{
    /**
     * @return mixed
     */
    public function handle();
}