<?php

if (!function_exists("app")) {
    function app($abstract = null)
    {
        $app = \Bootdi\App::getInstance();
        if ($abstract == null) {
            return $app->make("app");
        }
        return $app->make($abstract);
    }
}

if (!function_exists("config")) {
    function config($key, $defValue = null)
    {
        $app = \Bootdi\App::getInstance();
        return $app->make("config")->get($key, $defValue);
    }
}

if (!function_exists("env")) {
    function env($name)
    {
        return getenv($name);
    }
}