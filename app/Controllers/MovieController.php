<?php

namespace App\Controllers;

use App\Models\Movie;
use src\IDatabase;

class MovieController extends Controller
{
    public function __construct(IDatabase $dbh, $loader, $twig) {
        parent::__construct($dbh, $loader, $twig);
    }
    public function index()
    {
        $movies = Movie::all();
        echo '<h1>movie index</h1>';

        $this->view('movie/list');
    }

    public function rent()
    {

    }
}
