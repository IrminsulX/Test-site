<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        return view('admin.dashboard');
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