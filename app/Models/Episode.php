<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{

    protected $fillable = [
        'seasonId',
        'path',
        'description',
        'title',
        'time'
    ];


    use HasFactory;
}
