<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\PageView;
use App\Models\Game;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        $totalViews = PageView::count();
        $uniqueIps = PageView::distinct('ip')->count();
        
        $popularGames = Game::published()
            ->withCount(['pageViews as views_count' => function ($q) {
                $q->where('page_type', 'game');
            }])
            ->orderByDesc('views_count')
            ->take(10)
            ->get();

        $popularPosts = Post::published()
            ->withCount(['pageViews as views_count' => function ($q) {
                $q->where('page_type', 'post');
            }])
            ->orderByDesc('views_count')
            ->take(10)
            ->get();

        $viewsByDay = PageView::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $viewsByPage = PageView::select('page_type', DB::raw('count(*) as count'))
            ->groupBy('page_type')
            ->get();

        return view('admin.analytics', compact(
            'totalViews', 'uniqueIps', 'popularGames', 'popularPosts',
            'viewsByDay', 'viewsByPage'
        ));
    }
}
