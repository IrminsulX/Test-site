<?php
namespace App\Http\Controllers;
use App\Models\Game;
use App\Models\PageView;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $query = Game::published()->withCount('images');

        $status = $request->get('status');
        if ($status && in_array($status, ['released', 'beta', 'coming_soon'])) {
            $query->where('status', $status);
        }

        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'name':
                $query->orderBy('name');
                break;
            case 'newest':
            default:
                $query->latest();
                break;
        }

        $games = $query->get();
        return view('games.index', compact('games', 'status', 'sort'));
    }

    public function show(Game $game)
    {
        $game->load('images');
        if (auth()->check()) {
            $game->loadExists(['favoritedBy as is_favorited' => function ($q) {
                $q->where('user_id', auth()->id());
            }]);
        }
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
