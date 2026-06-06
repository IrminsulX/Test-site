<?php
namespace App\Http\Controllers;
use App\Models\ForumThread;
use App\Models\ForumReply;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $query = ForumThread::with('user', 'latestReply.user')
            ->withCount('replies');

        $category = $request->get('category');
        if ($category) {
            $query->where('category', $category);
        }

        $threads = $query->latest('is_pinned')->latest()->paginate(20);

        $categories = ['general' => 'General', 'support' => 'Support', 'suggestions' => 'Suggestions', 'off-topic' => 'Off-Topic'];

        return view('forum.index', compact('threads', 'categories', 'category'));
    }

    public function show(ForumThread $thread)
    {
        $thread->load('user', 'replies.user');
        return view('forum.show', compact('thread'));
    }

    public function create()
    {
        $games = Game::published()->get();
        $categories = ['general' => 'General', 'support' => 'Support', 'suggestions' => 'Suggestions', 'off-topic' => 'Off-Topic'];
        return view('forum.create', compact('games', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'game_id' => 'nullable|exists:games,id',
            'category' => 'nullable|string|in:general,support,suggestions,off-topic',
        ]);

        $data['user_id'] = Auth::id();
        ForumThread::create($data);

        return redirect()->route('forum.index')->with('success', 'Thread created!');
    }

    public function edit(ForumThread $thread)
    {
        if ($thread->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $games = Game::published()->get();
        $categories = ['general' => 'General', 'support' => 'Support', 'suggestions' => 'Suggestions', 'off-topic' => 'Off-Topic'];
        return view('forum.edit', compact('thread', 'games', 'categories'));
    }

    public function update(Request $request, ForumThread $thread)
    {
        if ($thread->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'game_id' => 'nullable|exists:games,id',
            'category' => 'nullable|string|in:general,support,suggestions,off-topic',
        ]);

        $thread->update($data);

        return redirect()->route('forum.show', $thread)->with('success', 'Thread updated!');
    }

    public function destroy(ForumThread $thread)
    {
        if ($thread->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $thread->delete();
        return redirect()->route('forum.index')->with('success', 'Thread deleted.');
    }

    public function reply(Request $request, ForumThread $thread)
    {
        $data = $request->validate(['body' => 'required|string']);
        $data['user_id'] = Auth::id();
        $data['forum_thread_id'] = $thread->id;
        ForumReply::create($data);

        return redirect()->route('forum.show', $thread)->with('success', 'Reply posted!');
    }

    public function editReply(ForumReply $reply)
    {
        if ($reply->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        return view('forum.reply-edit', compact('reply'));
    }

    public function updateReply(Request $request, ForumReply $reply)
    {
        if ($reply->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $data = $request->validate(['body' => 'required|string']);
        $reply->update($data);

        return redirect()->route('forum.show', $reply->thread)->with('success', 'Reply updated!');
    }

    public function destroyReply(ForumReply $reply)
    {
        if ($reply->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $thread = $reply->thread;
        $reply->delete();
        return redirect()->route('forum.show', $thread)->with('success', 'Reply deleted.');
    }

    public function togglePin(ForumThread $thread)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $thread->update(['is_pinned' => !$thread->is_pinned]);
        return back()->with('success', $thread->is_pinned ? 'Thread pinned.' : 'Thread unpinned.');
    }
}
