<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\ForumThread;
use App\Models\ForumReply;
use Illuminate\Http\Request;

class ForumModerationController extends Controller
{
    public function togglePin(ForumThread $thread)
    {
        $thread->update(['is_pinned' => !$thread->is_pinned]);
        return back()->with('success', $thread->is_pinned ? 'Thread pinned.' : 'Thread unpinned.');
    }

    public function destroyThread(ForumThread $thread)
    {
        $thread->delete();
        return redirect()->route('forum.index')->with('success', 'Thread deleted.');
    }

    public function destroyReply(ForumReply $reply)
    {
        $thread = $reply->thread;
        $reply->delete();
        return back()->with('success', 'Reply deleted.');
    }
}
