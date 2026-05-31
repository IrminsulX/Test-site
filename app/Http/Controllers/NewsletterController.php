<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

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
        ]);

        return back()->with('success', 'Thank you for subscribing!');
    }

    public function unsubscribe(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        NewsletterSubscriber::where('email', $request->email)->delete();

        return back()->with('success', 'You have been unsubscribed.');
    }
}
