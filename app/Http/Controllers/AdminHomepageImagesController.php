<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminHomepageImages;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageService;

class AdminHomepageImagesController extends Controller {
    
    public function index() {
        $images = AdminHomepageImages::where('type', 'featured')->get();
        return view('adminhomepages', compact('images'));
    }    

    // Fetch dashboard images
    public function getDashboardImages() {
        $dashboardImages = AdminHomepageImages::where('type', 'dashboard')->get();
        return view('dashboard-images', compact('dashboardImages'));
    }

    // Fetch featured game images
    public function getFeaturedGames() {
        $featuredGames = AdminHomepageImages::where('type', 'featured')->get();
        return view('featured-games', compact('featuredGames'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gameName' => 'required|string',
            'fileUpload' => 'required|image|mimes:jpg,png,gif,webp|max:10240',
            'type' => 'required|in:dashboard,featured',
        ]);

        $imagePath = ImageService::resizeAndStore($request->file('fileUpload'), 'images', 1200);

        AdminHomepageImages::create([
            'game_name' => trim($request->gameName),
            'image_path' => $imagePath,
            'type' => $request->type,
        ]);

        return back()->with('success', 'Image uploaded successfully.');
    }

    public function destroy(AdminHomepageImages $image) {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();
        return redirect()->back()->with('success', 'Image removed successfully');
    }

    public function update(Request $request, AdminHomepageImages $image) {
        $request->validate([
            'gameName' => 'required|string|max:255',
            'fileUpload' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        // Update game name
        $image->game_name = trim($request->gameName);

        if ($request->hasFile('fileUpload')) {
            Storage::disk('public')->delete($image->image_path);
            $filename = time() . '-' . uniqid() . '.' . $request->fileUpload->extension();
            $path = $request->fileUpload->storeAs('images', $filename, 'public');
            $image->image_path = $path;
        }

        $image->save();

        return redirect()->back()->with('success', 'Image updated successfully');
    }

    public function home()
{
    // Fetch images from the database
    $images = AdminHomepageImages::where('type', 'dashboard')->get();


    // Pass the images to the view
    return view('home', compact('images'));
}
    
}