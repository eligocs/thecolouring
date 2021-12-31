<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Childrenimage extends Model
{
    use HasFactory;
    protected $table = "childrenimages";
    protected $fillable = [
        'images'
    ];
}
