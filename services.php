<?php

use Dotenv\Dotenv;
use Src\Database\Database;
use Src\Database\Eloquent;
use Src\Dispatcher;
use Src\Request;
use Src\Router;
use Src\ServiceContainer;
use Jenssegers\Blade\Blade;
use Src\Validation;

return [

    'dotEnv' => function() {
        (Dotenv::createUnsafeImmutable(PROJECT_ROOT))->load();
    },

    'database' => function() {
        return new Database();
    },

    'eloquent' => function() {
        return new Eloquent();
    },

    'blade' => function() {
        return new Blade('resources/views', 'storage/cache');
    },

    'dispatcher' => function(ServiceContainer $container) {
        $dispatcher = new Dispatcher(
            $container->get('router'),
            $container->get(env('DB_ENGINE')),
            $container->get('blade')
        );
        $dispatcher->handle($container->get('request'));
        return $dispatcher;
    },

    'router' => function() {
        $router = new Router();
        require_once PROJECT_ROOT . 'routes/routes.php';
        return $router;
    },

    'request' => function() {
        return new Request(
            $_SERVER['REQUEST_METHOD'],
            $_SERVER['REQUEST_URI']
        );
    },

    'validation' => function() {
        return new Validation();
    }
];
