<?php

namespace App\Controllers;

use Jenssegers\Blade\Blade;
use Src\Database\IDatabase;

abstract class Controller
{
    protected Blade $blade;

    protected IDatabase $database;

    public function __construct(IDatabase $database, Blade $blade)
    {
        $this->blade = $blade;
        $this->database = $database;
    }

    protected function view($template, $data = [])
    {
        echo $this->blade->make($template, $data)->render();
    }

}
