<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class movieWantedToWatch extends Model
{
    protected $fillable = [
        'userId',
        'moviesId',
    ];

    use HasFactory;
}
