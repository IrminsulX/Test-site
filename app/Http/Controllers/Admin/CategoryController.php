<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = PostCategory::withCount('posts')->orderBy('name')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:post_categories,name',
            'slug' => 'nullable|string|max:255|unique:post_categories,slug',
        ]);

        PostCategory::create([
            'name' => $request->name,
            'slug' => $request->slug ?: \Illuminate\Support\Str::slug($request->name),
        ]);

        return back()->with('success', 'Category created.');
    }

    public function destroy(PostCategory $category)
    {
        $category->delete();
        return back()->with('success', 'Category deleted.');
    }
}
