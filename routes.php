<?php

use App\Controllers\MovieController;

$router->get('/', [MovieController::class, 'index']);


