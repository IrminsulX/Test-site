<?php
namespace App\Http\Controllers;
use App\Models\Game;
use App\Models\PageView;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::published()->withCount('images')->get();
        return view('games.index', compact('games'));
    }

    public function show(Game $game)
    {
        $game->load('images');
        PageView::create([
            'page_type' => 'game',
            'page_id' => $game->id,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'user_id' => auth()->id(),
        ]);
        return view('games.show', compact('game'));
    }
}
