<?php

if (function_exists("app")) {
    function app($service = null)
    {
        $app = \Bootdi\App::getInstance();
        if ($service == null) {
            return $app->make("app");
        }
        return $app->make($service);
    }
}

if (function_exists("env")) {
    function env($name)
    {
        return getenv($name);
    }
}