<?php

namespace app\Controllers;

use App\Models\Movie;

class MovieController
{
    public function index()
    {
        $movies = Movie::all();
        echo '<h1>movie index</h1>';
    }
}
