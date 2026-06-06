<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers,email',
        ]);

        NewsletterSubscriber::create([
            'email' => $request->email,
            'subscribed_at' => now(),
            'unsubscribe_token' => Str::random(64),
        ]);

        return back()->with('success', 'Thank you for subscribing!');
    }

    public function unsubscribe(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        NewsletterSubscriber::where('email', $request->email)->delete();

        return back()->with('success', 'You have been unsubscribed.');
    }

    public function unsubscribeByToken(string $token)
    {
        $subscriber = NewsletterSubscriber::where('unsubscribe_token', $token)->first();

        if ($subscriber) {
            $subscriber->delete();
            return view('newsletter.unsubscribed');
        }

        return redirect('/')->with('error', 'Invalid unsubscribe link.');
    }
}
