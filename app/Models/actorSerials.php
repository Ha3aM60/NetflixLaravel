<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class actorSerials extends Model
{
    protected $fillable = [
        'serialId',
        'actorId'
    ];
    use HasFactory;
}
