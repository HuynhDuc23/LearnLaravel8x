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
    }
    public function getEdit(Request $request)
    {
        $id = $request->id;
        $data = $this->post->findPostById($id);
        dd($data);
    }
    public function get()
    {
        return Post::withTrashed()->get();
    }
    public function show(Request $request)
    {
        $title = 'List Posts';
        $records = Post::withTrashed()->orderBy('deleted_at', 'asc')->paginate(2);
        $count = Post::onlyTrashed()->count();
        return view('clients.post.list', compact('title', 'records', 'count'));
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
            return redirect()->back()->with('msg-delete', ' Please Tick Select 1 of All !!!');
        }
        return redirect()->route('post.show')->with('msg', 'Delete Sucessfully')->with('success', 'Success');
    }
    public function restore()
    {
        Post::onlyTrashed()->restore();
        return redirect()->route('post.show')->with('msg', 'Restore Sucessfully');
    }
    public function softDelete(Request $request)
    {
        $id = $request->id;

        if (!empty($id)) {
            // Lấy bản ghi đã bị xóa mềm trước đó
            $data = Post::withTrashed()->find($id);

            if (!empty($data)) {
                // Thực hiện xóa vĩnh viễn
                $data->forceDelete();
                return redirect()->route('post.show')->with('msg', 'Deleted permanently with ID: ' . $id);
            } else {
                return redirect()->back()->with('msg', 'Cannot find post with ID: ' . $id);
            }
        }

        return redirect()->back()->with('msg', 'No ID provided.');
    }
    public function detailSoftDelete()
    {
        $data = Post::onlyTrashed()->get();
        dd($data);
    }
    public function restoreByIdPost(Request $request)
    {
        $id = $request->id;
        if (!empty($id)) {
            $post = Post::withTrashed()->find($id);
            if (!empty($post)) {
                $post->restore();
                return redirect()->route('post.show')->with('msg', 'Restore Sucessfully with ID: ' . $id);
            } else {
                return redirect()->back()->with('msg', 'Cannot find post with ID: ' . $id);
            }
        } else {
            return redirect()->back()->with('msg', 'No ID provided.');
        }
    }
    public function countComments()
    {
        // dem bai post ke ca post khong co comment
        $posts = Post::withCount('comments')->get();

        if (($posts)) {
            foreach ($posts as $post) {
                echo "Post ID: " . $post->id . ", Number of comments: " . $post->comments_count . "<br>";
            }
        }
    }
}
