<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userMoviesFavorite extends Model
{
    protected $fillable = [
        'userId',
        'movieId',
    ];
    use HasFactory;
}
