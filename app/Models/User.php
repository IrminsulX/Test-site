<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'avatar',
        'twitter',
        'discord',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin()
    {
        return $this->is_admin || $this->role === 'admin';
    }

    public function isModerator()
    {
        return $this->role === 'moderator' || $this->isAdmin();
    }

    public function isEditor()
    {
        return $this->role === 'editor' || $this->isAdmin();
    }

    public function hasRole($role)
    {
        return $this->role === $role || $this->isAdmin();
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function forumThreads()
    {
        return $this->hasMany(ForumThread::class);
    }

    public function favoritedGames()
    {
        return $this->belongsToMany(Game::class, 'game_user')->withTimestamps();
    }
}
