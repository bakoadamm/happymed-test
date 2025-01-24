<?php

declare(strict_types=0);

use Src\App;
use Src\ServiceContainer;

define('PROJECT_ROOT', __DIR__ . DIRECTORY_SEPARATOR);

require_once(PROJECT_ROOT . 'vendor/autoload.php');

error_reporting( E_ALL & ~E_STRICT & ~E_DEPRECATED );
ini_set( 'display_errors', 1);

(new App(new ServiceContainer(require_once PROJECT_ROOT. 'services.php')))->run();
