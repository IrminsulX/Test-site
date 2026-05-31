<?php
namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $data = $request->validate([
            'body' => 'required|string|max:2000',
        ]);

        $post->comments()->create([
            'user_id' => Auth::id(),
            'body' => $data['body'],
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Comment posted!');
    }

    public function destroy(PostComment $comment)
    {
        $this->checkAuthorization($comment);
        $comment->delete();
        return redirect()->route('posts.show', $comment->post)->with('success', 'Comment deleted.');
    }

    private function checkAuthorization(PostComment $comment)
    {
        if (Auth::id() !== $comment->user_id && !Auth::user()?->isAdmin()) {
            abort(403);
        }
    }
}
