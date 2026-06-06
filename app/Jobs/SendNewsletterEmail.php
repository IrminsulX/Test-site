<?php

namespace App\Jobs;

use App\Models\NewsletterSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewsletterEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $backoff = 60;

    public function __construct(
        public NewsletterSubscriber $subscriber,
        public string $subject,
        public string $body,
    ) {}

    public function handle(): void
    {
        $unsubscribeUrl = $this->subscriber->unsubscribe_url;

        $bodyWithUnsubscribe = $this->body . "\n\n---\nTo unsubscribe, visit: {$unsubscribeUrl}";

        Mail::raw($bodyWithUnsubscribe, function ($message) {
            $message->to($this->subscriber->email)
                ->subject($this->subject)
                ->from(config('mail.from.address'), config('app.name', 'Irminsul Studio'));
        });
    }
}
