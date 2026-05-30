<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        return view('admin.dashboard'); // Ensure this view exists
    }

    /**
     * Display the list of users for the admin.
     */
    public function users()
    {
        return view('admin.users'); // Ensure this view exists
    }
}