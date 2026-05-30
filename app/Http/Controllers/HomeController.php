<?php

namespace App\Http\Controllers;
use App\Models\AdminHomepageImages;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
 

    public function home() {
        $images = AdminHomepageImages::where('type', 'dashboard')->get();

        dd($images); // Debugging: See if images are retrieved

        return view('home', compact('images'));
    }

}
