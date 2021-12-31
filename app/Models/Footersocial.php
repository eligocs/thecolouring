<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footersocial extends Model
{
    use HasFactory;
    protected $table = 'footersocials';
    protected $fillable = [
        'social_id', 'link'
    ];
}
