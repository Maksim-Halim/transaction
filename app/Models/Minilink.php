<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Minilink extends Model
{
    use HasFactory;
    protected $fillable = [
        'urls',
        'url_min',
    ];

}
