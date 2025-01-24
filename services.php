<?php

use Src\Database;
use Src\Dispatcher;
use Src\Eloquent;
use Src\Request;
use Src\Router;
use Src\ServiceContainer;
use Twig\Loader\FilesystemLoader;

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
            $container->get('eloquent'),
            $container->get('twigLoader'),
            $container->get('twig')
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
    },

    'twigLoader' => function() {
        $loader = new FilesystemLoader('resources/views');
        $loader->addPath('resources/views','templates');
        return $loader;
    },

    'twig' => function(ServiceContainer $container) {
        $twig = new \Twig\Environment($container->get('twigLoader'), [
            'debug' => true,
            'autoescape' => false
        ]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());

        return $twig;
    },
];
