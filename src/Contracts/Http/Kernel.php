<?php

namespace Bootdi\Contracts\Http;


interface Kernel
{
    /**
     * run kernel
     *
     * @return mixed
     */
    public function start();
}