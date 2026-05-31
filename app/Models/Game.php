<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'play_url', 'status', 'featured_image', 'is_published'];

    protected function casts(): array
    {
        return ['is_published' => 'boolean'];
    }

    protected static function booted(): void
    {
        static::creating(function (Game $game) {
            if (empty($game->slug)) {
                $game->slug = Str::slug($game->name);
            }
        });
    }

    public function images()
    {
        return $this->hasMany(GameImage::class)->orderBy('sort_order');
    }

    public function threads()
    {
        return $this->hasMany(ForumThread::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'game_user')->withTimestamps();
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
