<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminHomepageImages extends Model
{
    protected $fillable = ['game_name', 'image_path', 'type'];

    public function scopeDashboard($query)
    {
        return $query->where('type', 'dashboard');
    }

    public function scopeFeatured($query)
    {
        return $query->where('type', 'featured');
    }
}

