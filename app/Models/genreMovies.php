<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class genreMovies extends Model
{
    protected $fillable = [
        'genreId',
        'moviesId'
    ];
    use HasFactory;
}
