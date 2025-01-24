<?php

namespace app\Controllers;

use src\IDatabase;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{
    protected FilesystemLoader $loader;

    protected Environment $twig;

    protected IDatabase $database;

    public function __construct(IDatabase $database, FilesystemLoader $loader, Environment $twig) {
        $this->loader   = $loader;
        $this->twig     = $twig;
        $this->database = $database;
    }

    protected function view($template, $data = []) {
        echo ($this->twig->load("@templates/{$template}.twig"))->render($data);
    }

}
