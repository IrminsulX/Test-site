<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ForumThread extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'slug', 'body', 'user_id', 'game_id', 'category', 'is_pinned'];

    protected function casts(): array
    {
        return ['is_pinned' => 'boolean'];
    }

    protected static function booted(): void
    {
        static::creating(function (ForumThread $thread) {
            if (empty($thread->slug)) {
                $thread->slug = Str::slug($thread->title);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function replies()
    {
        return $this->hasMany(ForumReply::class);
    }

    public function latestReply()
    {
        return $this->hasOne(ForumReply::class)->latestOfMany();
    }

    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}
