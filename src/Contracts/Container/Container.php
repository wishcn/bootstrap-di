<?php

namespace Bootdi\Contracts\Container;


interface Container
{
    /**
     * return container
     *
     * @param string $abstract
     * @param array $parameters
     * @return mixed
     */
    public function make($abstract, $parameters = []);
}