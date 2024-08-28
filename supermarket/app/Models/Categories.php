<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categories extends Model
{
    use HasFactory;

    protected $table = "categories"; // Đặt tên bảng, nếu khác với mặc định

    public function posts()
    {
        return $this->belongsToMany(
            Post::class,            // Model liên quan (Post)
            'categories_posts',     // Tên bảng trung gian (categories_posts)
            'categories_id',        // Tên cột khóa ngoại của bảng hiện tại trong bảng trung gian (categories_id)
            'posts_id'              // Tên cột khóa ngoại của model liên quan trong bảng trung gian (posts_id)
        )->withPivot('created_at');  // Lấy thêm cột created_at từ bảng trung gian
    }
}
