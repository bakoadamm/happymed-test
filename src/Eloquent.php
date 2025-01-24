<?php


namespace Src;

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher as IlluminateDispatcher;

class Eloquent implements IDatabase {

    private $capsule;

    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $dbname = 'happymed';

    public function __construct()
    {
        $this->capsule = new Capsule;
        $this->capsule->setAsGlobal();
        $this->capsule->setEventDispatcher(new IlluminateDispatcher(new Container));
        $this->capsule->bootEloquent();
        $this->capsule->addConnection([
            'driver' => 'mysql',
            'host' => $this->host,
            'database' => $this->dbname,
            'username' => $this->user,
            'password' => $this->pass,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);
    }
}
