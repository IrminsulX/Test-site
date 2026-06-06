<?php
namespace App\Http\Controllers;
use App\Models\Game;
use App\Models\Post;
use App\Models\ForumThread;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        $games = collect();
        $posts = collect();
        $threads = collect();
        $teamMembers = collect();

        if ($query) {
            $request->validate(['q' => 'string|max:100']);
            $escaped = '%' . addslashes($query) . '%';

            $games = Game::where('name', 'like', $escaped)
                ->orWhere('description', 'like', $escaped)
                ->published()
                ->take(5)
                ->get();

            $posts = Post::where('title', 'like', $escaped)
                ->orWhere('content', 'like', $escaped)
                ->published()
                ->take(5)
                ->get();

            $threads = ForumThread::where('title', 'like', $escaped)
                ->orWhere('body', 'like', $escaped)
                ->take(5)
                ->get();

            $teamMembers = TeamMember::where('name', 'like', $escaped)
                ->orWhere('role', 'like', $escaped)
                ->orWhere('bio', 'like', $escaped)
                ->take(5)
                ->get();
        }

        return view('search.index', compact('query', 'games', 'posts', 'threads', 'teamMembers'));
    }
}
