<?php
namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\PageView;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::published()->latest('published_at')->paginate(9);
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load('comments.user');
        PageView::create([
            'page_type' => 'post',
            'page_id' => $post->id,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'user_id' => auth()->id(),
        ]);
        return view('posts.show', compact('post'));
    }
}
