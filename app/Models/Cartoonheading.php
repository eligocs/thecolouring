<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartoonheading extends Model
{
    use HasFactory;
    protected $table = 'cartoonheadings';
    protected $fillable = [
        'heading'
    ];
}
