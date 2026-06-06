<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\User;
use App\Models\PageView;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('home', 'index');
    }

    public function index()
    {
        return $this->home();
    }

    public function home()
    {
        $gameCount = Game::published()->count();
        $userCount = User::count();
        $totalViews = PageView::count();

        return view('home', compact('gameCount', 'userCount', 'totalViews'));
    }
}
