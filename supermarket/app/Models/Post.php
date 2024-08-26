<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    // cấu hình table
    // chữ thường
    // mỗi chữ cách nhau bởi dấu gạch dưới_
    // dạng số nhiều

    // config
    // Tạo Model Post -> thì tên table sẽ là posts
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $fillable = ['title', 'name']; // cho phép insert vào bảng

    // khong tu dong insert data created at va updated at
    public $timestamps = false;


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
    public static function  findPostById($id)
    {
        // Tìm post theo id
        return Post::find($id);
    }
    public function getPosts()
    {
        return Post::all();
    }
    public function deletePostById($id)
    {
        $post = new Post();
        $result = Post::findPostById($id);
        if ($result) {
            //$result->delete();
            Post::destroy($id);
            return true;
        } else {
            return false;
        }
    }
}
