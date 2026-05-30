<?php
namespace App\Http\Controllers;
use App\Models\Game;
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
        return view('games.show', compact('game'));
    }
}
