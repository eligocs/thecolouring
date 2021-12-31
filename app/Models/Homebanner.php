<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homebanner extends Model
{
    use HasFactory;

    protected $table ="homebanner";
    protected $fillable = [
        'bannerimage',
        'text1',
        'text2',
    ];
}
