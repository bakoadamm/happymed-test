<?php

use App\Controllers\MovieController;

$router->get('/', [MovieController::class, 'index']);

$router->post('/rent', [MovieController::class, 'rent']);


