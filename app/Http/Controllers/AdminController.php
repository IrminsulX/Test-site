<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Game;
use App\Models\Post;
use App\Models\ActivityLog;
use App\Models\NewsletterSubscriber;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        $gameCount = Game::count();
        $postCount = Post::count();
        $userCount = User::count();
        $messageCount = ContactMessage::count();
        $subscriberCount = NewsletterSubscriber::count();
        $logCount = ActivityLog::count();

        return view('admin.dashboard', compact(
            'gameCount', 'postCount', 'userCount',
            'messageCount', 'subscriberCount', 'logCount'
        ));
    }

    /**
     * Display the list of users for the admin.
     */
    public function users()
    {
        $users = User::orderBy('name')->paginate(30);
        return view('admin.users', compact('users'));
    }

    /**
     * Update a user's role.
     */
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,editor,moderator,admin',
        ]);

        $user->role = $request->role;
        $user->save();

        return back()->with('success', "{$user->name}'s role updated to {$request->role}.");
    }
}