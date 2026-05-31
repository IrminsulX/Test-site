<?php
namespace App\Http\Controllers;
use App\Models\Game;
use App\Models\Post;
use App\Models\ForumThread;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        $games = collect();
        $posts = collect();
        $threads = collect();

        if ($query) {
            $request->validate(['q' => 'string|max:100']);
            $games = Game::where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->published()
                ->take(5)
                ->get();

            $posts = Post::where('title', 'like', "%{$query}%")
                ->orWhere('content', 'like', "%{$query}%")
                ->published()
                ->take(5)
                ->get();

            $threads = ForumThread::where('title', 'like', "%{$query}%")
                ->orWhere('body', 'like', "%{$query}%")
                ->take(5)
                ->get();
        }

        return view('search.index', compact('query', 'games', 'posts', 'threads'));
    }
}
