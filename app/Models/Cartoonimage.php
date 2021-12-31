<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartoonimage extends Model
{
    use HasFactory;
    protected $table = 'cartoonimages';
    protected $fillable = [
        'images', 'text'
    ];
}
    