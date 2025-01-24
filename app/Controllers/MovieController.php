<?php

namespace App\Controllers;

use App\Models\Movie;
use App\Models\Rental;
use Src\IDatabase;
use Src\Request;

class MovieController extends Controller
{
    public function __construct(IDatabase $dbh, $loader, $twig) {
        parent::__construct($dbh, $loader, $twig);
    }
    public function index()
    {
        $this->view('movie/list', ['movies' => Movie::with('rentals')->get()]);
    }

    public function rent(Request $request, $params)
    {
        $movieId = htmlspecialchars($_POST['movie_id']);
        $customerName = htmlspecialchars($_POST['customer_name']);

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
