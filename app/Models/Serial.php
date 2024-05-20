<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serial extends Model
{

    protected $fillable = [
        'country',
        'description',
        'image',
        'slug',
        'time',
        'title',
        'directorId',
        'age',
        'year',
        'video'
    ];

    use HasFactory;
}
