<?php

use Src\Database;
use Src\Dispatcher;
use Src\Eloquent;
use Src\Request;
use Src\Router;
use Src\ServiceContainer;

return [

    'database' => function() {
        return new Database();
    },

    'eloquent' => function() {
        return new Eloquent();
    },

    'dispatcher' => function(ServiceContainer $container) {
        $dispatcher = new Dispatcher(
            $container->get('router'),
            $container->get('eloquent')
        );
        $dispatcher->handle($container->get('request'));
        return $dispatcher;
    },

    'router' => function() {
        $router = new Router();
        require_once PROJECT_ROOT . 'routes.php';
        return $router;
    },

    'request' => function() {
        return new Request(
            $_SERVER['REQUEST_METHOD'],
            $_SERVER['REQUEST_URI']
        );
    }
];
