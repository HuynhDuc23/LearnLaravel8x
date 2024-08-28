<?php

namespace App\Http\Controllers;

use App\Models\Categories;

class CategoryController extends Controller
{
    public function index()
    {
        // $category = Categories::find(1);

        $posts = Categories::find(1)->posts;
        //$posts = $category->posts;
        dd($posts->count());
        // dd($category = Categories::find(2)->posts);
        foreach ($category->posts as $post) {
            // dd($post->pivot->created);
            echo $post->pivot->created_at;
        }
    }
}
