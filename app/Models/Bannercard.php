<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bannercard extends Model
{
    use HasFactory;
    protected $table = 'bannercards';
    protected $fillable = [
        'cardimage', 'maintext', 'subtext'
    ];
}
