<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::withCount('images')->latest()->paginate(20);
        return view('admin.games.index', compact('games'));
    }

    public function create()
    {
        return view('admin.games.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'play_url' => 'nullable|url|max:255',
            'status' => 'required|in:released,beta,coming_soon',
            'featured_image' => 'nullable|image|mimes:jpg,png,gif,webp|max:2048',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('games', 'public');
        }

        $data['is_published'] = $request->boolean('is_published');
        Game::create($data);

        return redirect()->route('admin.games.index')->with('success', 'Game created!');
    }

    public function edit(Game $game)
    {
        return view('admin.games.edit', compact('game'));
    }

    public function update(Request $request, Game $game)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'play_url' => 'nullable|url|max:255',
            'status' => 'required|in:released,beta,coming_soon',
            'featured_image' => 'nullable|image|mimes:jpg,png,gif,webp|max:2048',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($game->featured_image) {
                Storage::disk('public')->delete($game->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('games', 'public');
        }

        $data['is_published'] = $request->boolean('is_published');
        $game->update($data);

        return redirect()->route('admin.games.index')->with('success', 'Game updated!');
    }

    public function destroy(Game $game)
    {
        if ($game->featured_image) {
            Storage::disk('public')->delete($game->featured_image);
        }
        foreach ($game->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }
        $game->delete();
        return redirect()->route('admin.games.index')->with('success', 'Game deleted.');
    }

    public function images(Game $game)
    {
        $game->load('images');
        return view('admin.games.images', compact('game'));
    }

    public function uploadImage(Request $request, Game $game)
    {
        $data = $request->validate([
            'image' => 'required|image|mimes:jpg,png,gif,webp|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        $data['image_path'] = $request->file('image')->store('games/gallery', 'public');
        $game->images()->create($data);

        return redirect()->route('admin.games.images', $game)->with('success', 'Image added!');
    }

    public function deleteImage(Game $game, \App\Models\GameImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();
        return redirect()->route('admin.games.images', $game)->with('success', 'Image removed.');
    }
}
