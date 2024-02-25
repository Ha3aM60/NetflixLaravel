<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Directors extends Model
{

    protected $fillable = [
        'name',
        'image',
        'placeOfBirth',
        'birthday',
    ];

    use HasFactory;
}
