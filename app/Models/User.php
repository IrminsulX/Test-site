<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // app/Models/User.php
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

    public function favoritedGames()
    {
        return $this->belongsToMany(Game::class, 'game_user')->withTimestamps();
    }
}
