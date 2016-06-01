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

if (! function_exists('value')) {
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if (!function_exists("config")) {
    function config($name, $default = null)
    {
        $app = \Bootdi\App::getInstance();
        return $app->make("config")->get($name, value($default));
    }
}

if (!function_exists("env")) {
    function env($name, $default = null)
    {
        $value = getenv($name);

        if ($value === false) {
            return value($default);
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return;
        }

        return $value;
    }
}