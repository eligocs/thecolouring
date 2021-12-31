<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homewelcome extends Model
{
    use HasFactory;

    protected $table = 'homewelcomes';
    protected $fillable = [
        'image', 'text', 'description'
    ];
}
