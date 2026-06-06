<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewsletterSubscriber extends Model
{
    protected $fillable = ['email', 'subscribed_at', 'unsubscribe_token'];

    protected function casts(): array
    {
        return [
            'subscribed_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (NewsletterSubscriber $subscriber) {
            if (empty($subscriber->unsubscribe_token)) {
                $subscriber->unsubscribe_token = Str::random(64);
            }
        });
    }

    public function getUnsubscribeUrlAttribute(): string
    {
        return route('newsletter.unsubscribe.token', $this->unsubscribe_token);
    }
}
