<?php

namespace Src\Database;

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher as IlluminateDispatcher;

class Eloquent implements IDatabase
{
    private $capsule;

    public function __construct()
    {
        $this->capsule = new Capsule;
        $this->capsule->setAsGlobal();
        $this->capsule->setEventDispatcher(new IlluminateDispatcher(new Container));
        $this->capsule->bootEloquent();
        $this->capsule->addConnection([
            'driver' => env('DB_CONNECTION'),
            'host' => env('DB_HOST'),
            'database' => env('DB_DATABASE'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);
    }
}
