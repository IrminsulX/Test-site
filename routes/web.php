<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminHomepageImagesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SearchController;

use App\Http\Controllers\LibraryController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\NewsletterController as AdminNewsletterController;

Auth::routes();

// Public pages
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home.page');
Route::get('/gamespage', function () { return view('gamespage'); })->name('gamespage');
Route::get('/aboutpage', function () {
    $teamMembers = \App\Models\TeamMember::ordered()->get();
    return view('aboutpage', compact('teamMembers'));
})->name('aboutpage');
Route::get('/contact', function () { return view('contact'); })->name('contact');

// Games
Route::get('/games', [GameController::class, 'index'])->name('games.index');
Route::get('/games/{game}', [GameController::class, 'show'])->name('games.show');

// Blog / News
Route::get('/news', [PostController::class, 'index'])->name('posts.index');
Route::get('/news/{post}', [PostController::class, 'show'])->name('posts.show');

// Forum
Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create')->middleware('auth');
Route::post('/forum', [ForumController::class, 'store'])->name('forum.store')->middleware('auth');
Route::get('/forum/{thread}', [ForumController::class, 'show'])->name('forum.show');
Route::post('/forum/{thread}/reply', [ForumController::class, 'reply'])->name('forum.reply')->middleware('auth');

// Profiles
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

// Contact form submission
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store')->middleware('throttle:5,60');

// Comments on blog posts
Route::post('/news/{post}/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth', 'throttle:10,60');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy')->middleware('auth');

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Newsletter subscription
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::post('/newsletter/unsubscribe', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

// Game library (favorites)
Route::post('/games/{game}/library', [LibraryController::class, 'toggle'])->name('library.toggle')->middleware('auth');

// Legal & Press Kit
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/terms', 'terms')->name('terms');
Route::view('/press-kit', 'press-kit')->name('press-kit');

// Sitemap
Route::get('/sitemap.xml', function () {
    $games = \App\Models\Game::published()->get();
    $posts = \App\Models\Post::published()->get();
    return response()->view('sitemap', compact('games', 'posts'))->header('Content-Type', 'application/xml');
});

// Admin routes
Route::middleware(['admin', \App\Http\Middleware\LogAdminActivity::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::patch('/admin/users/{user}/role', [AdminController::class, 'updateRole'])->name('admin.users.updateRole');

    // Blog management
    Route::get('/admin/posts', [\App\Http\Controllers\Admin\PostController::class, 'index'])->name('admin.posts.index');
    Route::get('/admin/posts/create', [\App\Http\Controllers\Admin\PostController::class, 'create'])->name('admin.posts.create');
    Route::post('/admin/posts', [\App\Http\Controllers\Admin\PostController::class, 'store'])->name('admin.posts.store');
    Route::get('/admin/posts/{post}/edit', [\App\Http\Controllers\Admin\PostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('/admin/posts/{post}', [\App\Http\Controllers\Admin\PostController::class, 'update'])->name('admin.posts.update');
    Route::delete('/admin/posts/{post}', [\App\Http\Controllers\Admin\PostController::class, 'destroy'])->name('admin.posts.destroy');

    // Game management
    Route::get('/admin/games', [\App\Http\Controllers\Admin\GameController::class, 'index'])->name('admin.games.index');
    Route::get('/admin/games/create', [\App\Http\Controllers\Admin\GameController::class, 'create'])->name('admin.games.create');
    Route::post('/admin/games', [\App\Http\Controllers\Admin\GameController::class, 'store'])->name('admin.games.store');
    Route::get('/admin/games/{game}/edit', [\App\Http\Controllers\Admin\GameController::class, 'edit'])->name('admin.games.edit');
    Route::put('/admin/games/{game}', [\App\Http\Controllers\Admin\GameController::class, 'update'])->name('admin.games.update');
    Route::delete('/admin/games/{game}', [\App\Http\Controllers\Admin\GameController::class, 'destroy'])->name('admin.games.destroy');
    Route::get('/admin/games/{game}/images', [\App\Http\Controllers\Admin\GameController::class, 'images'])->name('admin.games.images');
    Route::post('/admin/games/{game}/images', [\App\Http\Controllers\Admin\GameController::class, 'uploadImage'])->name('admin.games.uploadImage');
    Route::delete('/admin/games/{game}/images/{image}', [\App\Http\Controllers\Admin\GameController::class, 'deleteImage'])->name('admin.games.deleteImage');

    // Team management
    Route::get('/admin/team', [\App\Http\Controllers\Admin\TeamMemberController::class, 'index'])->name('admin.team.index');
    Route::get('/admin/team/create', [\App\Http\Controllers\Admin\TeamMemberController::class, 'create'])->name('admin.team.create');
    Route::post('/admin/team', [\App\Http\Controllers\Admin\TeamMemberController::class, 'store'])->name('admin.team.store');
    Route::get('/admin/team/{teamMember}/edit', [\App\Http\Controllers\Admin\TeamMemberController::class, 'edit'])->name('admin.team.edit');
    Route::put('/admin/team/{teamMember}', [\App\Http\Controllers\Admin\TeamMemberController::class, 'update'])->name('admin.team.update');
    Route::delete('/admin/team/{teamMember}', [\App\Http\Controllers\Admin\TeamMemberController::class, 'destroy'])->name('admin.team.destroy');

    // Activity log
    Route::get('/admin/logs', [ActivityLogController::class, 'index'])->name('admin.logs');

    // Newsletter management
    Route::get('/admin/newsletter', [AdminNewsletterController::class, 'index'])->name('admin.newsletter.index');
    Route::get('/admin/newsletter/broadcast', [AdminNewsletterController::class, 'broadcastForm'])->name('admin.newsletter.broadcast');
    Route::post('/admin/newsletter/broadcast', [AdminNewsletterController::class, 'broadcast'])->name('admin.newsletter.broadcast.send');

    // Contact messages
    Route::get('/admin/messages', [\App\Http\Controllers\Admin\MessageController::class, 'index'])->name('admin.messages.index');
    Route::get('/admin/messages/{message}', [\App\Http\Controllers\Admin\MessageController::class, 'show'])->name('admin.messages.show');
    Route::delete('/admin/messages/{message}', [\App\Http\Controllers\Admin\MessageController::class, 'destroy'])->name('admin.messages.destroy');
});

// Legacy admin homepage management (kept for backwards compatibility)
Route::get('/adminhomepages', function () { return view('adminhomepages'); })->name('adminhomepages');
Route::get('/adminhomepage', [AdminHomepageImagesController::class, 'index']);
Route::get('/dashboard', [AdminHomepageImagesController::class, 'index']);
Route::post('/upload', [AdminHomepageImagesController::class, 'store'])->name('upload.image');
Route::delete('/delete/{image}', [AdminHomepageImagesController::class, 'destroy'])->name('delete.image');
Route::post('/edit/{image}', [AdminHomepageImagesController::class, 'update'])->name('edit.image');
Route::get('/dashboard-images', [AdminHomepageImagesController::class, 'getDashboardImages'])->name('dashboard.images');
Route::get('/featured-games', [AdminHomepageImagesController::class, 'getFeaturedGames'])->name('featured.games');
