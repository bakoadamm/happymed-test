<?php

namespace Src;

class ServiceContainer {

    private $services;

    public function __construct(array $services = [])
    {
        $this->services = $services;
    }

    public function put($key, $value)
    {
        $this->services[$key] = $value;
    }

    public function get($key)
    {
        if( ! array_key_exists($key, $this->services)) {
            throw new \Exception($key);
        }

        if(is_callable($this->services[$key])) {
            $factory = $this->services[$key];
            $this->services[$key] = $factory($this);
        }

        return $this->services[$key];
    }
}
