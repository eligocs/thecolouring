<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Childrenheading extends Model
{
    use HasFactory;
    protected $table = 'childrenheadings';
    protected $fillable = [
        'heading'
    ];
}
