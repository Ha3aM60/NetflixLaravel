<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class genreSerials extends Model
{
    protected $fillable = [
        'genreId',
        'serialsId'
    ];
    use HasFactory;
}
