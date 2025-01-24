<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $table = 'rentals';

    public $timestamps = false;

    protected $fillable = [
        'movie_id',
        'customer_name',
        'rental_date'
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
