<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userSerialsFavorite extends Model
{
    protected $fillable = [
        'userId',
        'serialsId',
    ];
    use HasFactory;
}
