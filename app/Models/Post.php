<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'content', 'excerpt', 'featured_image', 'user_id', 'category_id', 'is_published', 'published_at'];

    protected function casts(): array
    {
        return ['is_published' => 'boolean', 'published_at' => 'datetime'];
    }

    protected static function booted(): void
    {
        static::creating(function (Post $post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(PostCategory::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }

    public function pageViews()
    {
        return $this->hasMany(PageView::class, 'page_id')->where('page_type', 'post');
    }
}
