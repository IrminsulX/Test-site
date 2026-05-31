<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function toggle(Game $game)
    {
        $user = auth()->user();

        if ($user->favoritedGames()->where('game_id', $game->id)->exists()) {
            $user->favoritedGames()->detach($game->id);
            $message = 'Game removed from your library.';
        } else {
            $user->favoritedGames()->attach($game->id);
            $message = 'Game added to your library!';
        }

        return back()->with('success', $message);
    }
}
