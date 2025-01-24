<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movies';

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
