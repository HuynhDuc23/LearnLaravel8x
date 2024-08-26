<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $post = null;
    public function __construct()
    {
        $this->post = new Post();
    }
    public function index()
    {
        $data = $this->post->insertData();
        dd('ok');
    }
    public function getEdit(Request $request)
    {
        $id = $request->id;
        $data = $this->post->findPostById($id);
        dd($data);
    }
    public function get()
    {
        $data = $this->post->getPosts();
        dd($data);
    }
    // public function delete(Request $request)
    // {
    //     $id = $request->id;
    //     $data = $this->post->deletePostById($id);
    //     if ($data == true) {
    //         dd('Delete success');
    //     } else {
    //         dd('Delete failed');
    //     }
    // }
    public function show(Request $request)
    {
        $title = 'List Posts';
        $records = Post::all();
        return view('clients.post.list', compact('title', 'records'));
    }
    public function delete(Request $request)
    {
        $ids = $request->ids;
        if (!empty($ids)) {
            foreach ($ids as $id) {
                $data = Post::find($id);
                if (!empty($data)) {
                    $data->delete();
                } else {
                    return redirect()->back()->with('msg', ' Please , Cant not delete ');
                }
            }
        } else {
            return redirect()->back()->with('msg', ' Cant not delete ');
        }
        return redirect()->route('post.show')->with('msg', 'Delete Sucessfully')->with('success', 'Success');
    }
}
