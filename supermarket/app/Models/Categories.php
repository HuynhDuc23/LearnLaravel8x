<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categories extends Model
{
    use HasFactory;

    protected $table = "categories";

    public function posts()
    {
        return $this->belongsToMany(
            Post::class,
            'categories_post',
            'categories_id',
            'posts_id',
        )->withPivot('created_at', 'status');
    }
}
