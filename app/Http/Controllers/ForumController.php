<?php
namespace App\Http\Controllers;
use App\Models\ForumThread;
use App\Models\ForumReply;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index()
    {
        $threads = ForumThread::with('user', 'latestReply.user')
            ->withCount('replies')
            ->latest('is_pinned')
            ->latest()
            ->paginate(20);
        return view('forum.index', compact('threads'));
    }

    public function show(ForumThread $thread)
    {
        $thread->load('user', 'replies.user');
        return view('forum.show', compact('thread'));
    }

    public function create()
    {
        $games = Game::published()->get();
        return view('forum.create', compact('games'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'game_id' => 'nullable|exists:games,id',
        ]);

        $data['user_id'] = Auth::id();
        ForumThread::create($data);

        return redirect()->route('forum.index')->with('success', 'Thread created!');
    }

    public function reply(Request $request, ForumThread $thread)
    {
        $data = $request->validate(['body' => 'required|string']);
        $data['user_id'] = Auth::id();
        $data['forum_thread_id'] = $thread->id;
        ForumReply::create($data);

        return redirect()->route('forum.show', $thread)->with('success', 'Reply posted!');
    }
}
