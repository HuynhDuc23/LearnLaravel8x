<?php

namespace App\Models;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $fillable = ['title', 'name']; // cho phép insert vào bảng


    // khong tu dong insert data created at va updated at
    //public $timestamps = false;
    // protected $dates = ['deleted_at'];

    public function categories()
    {
        return $this->belongsToMany(
            Categories::class,
            'categories_post',
            'posts_id',
            'categories_id'
        )->withPivot('created_at', 'status');
    }
    public function insertData()
    {
        // Thêm dữ liệu vào bảng posts
        // $post = new Post();
        // $post->title = 'Test insert Data';
        // $post->name = 'Nội dung test';
        // $post->save();
        $data = [
            'title' => 'This is a test',
            'name' => 'name'
        ];
        Post::create($data);
    }
}
