<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'category_id';

    public function comments()
    {
        return $this->hasManyThrough(Comments::class, Posts::class, 'category_id', 'post_id');
    }

    public function posts()
    {
        return $this->hasMany(Posts::class, 'category_id', 'category_id');
    }

}
