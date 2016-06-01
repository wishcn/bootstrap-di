<?php

namespace Bootdi\Contracts\Container;


interface Container
{
    /**
     *
     * @param string $abstract
     * @param array $parameters
     * @return mixed
     */
    public function make($abstract, $parameters = []);
}