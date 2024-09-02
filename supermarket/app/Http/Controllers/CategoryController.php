<?php

namespace App\Http\Controllers;

use App\Models\Categories;

class CategoryController extends Controller
{
    public function index()
    {
        // $category = Categories::find(1);
        // \DB::enableQueryLog();
        $posts = Categories::find(2)->posts;
        // dd(\DB::getQueryLog());
        foreach ($posts as $post) {
            echo $post->pivot->created_at;
            echo " ";
            echo $post->pivot->status;

            echo "<br>";
        }
    }
}
