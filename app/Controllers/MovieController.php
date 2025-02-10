<?php

namespace App\Controllers;

use App\Models\Movie;
use App\Models\Rental;
use Jenssegers\Blade\Blade;
use Src\Database\IDatabase;
use Src\Request;

class MovieController extends Controller
{
    public function __construct(IDatabase $dbh, Blade $blade) {
        parent::__construct($dbh, $blade);
    }
    public function index()
    {
        $this->view('movie.list', ['movies' => Movie::with('rentals')->get()]);
    }

    public function rent(Request $request, $params)
    {
        $movieId = htmlspecialchars($request->get('movie_id'));
        $customerName = htmlspecialchars($request->get('customer_name'));

        $isExist = Rental::where('movie_id', $movieId)->first();

        if(!$isExist) {
            Rental::create([
                'movie_id' => $movieId,
                'customer_name' => $customerName,
                'rental_date' => date('Y-m-d')
            ]);
            header("Location: /");
            exit;
        }

        die("A filmhez már tartozik foglalás");

    }
}
