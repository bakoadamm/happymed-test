<?php

namespace Src;

class App
{
    private ServiceContainer $container;

    public function __construct(ServiceContainer $container)
    {
        $this->container = $container;
    }

    public function run(): void
    {
        $this->container->get('dotEnv');
        $this->container->get('dispatcher');
    }
}
