<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Bus;
use Illuminate\Bus\Batchable;

class NewsletterController extends Controller
{
    public function index()
    {
        $subscribers = NewsletterSubscriber::latest()->paginate(30);
        return view('admin.newsletter.index', compact('subscribers'));
    }

    public function broadcastForm()
    {
        return view('admin.newsletter.broadcast');
    }

    public function broadcast(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $subscribers = NewsletterSubscriber::all();

        if ($subscribers->isEmpty()) {
            return back()->with('error', 'No subscribers to send to.');
        }

        $jobs = $subscribers->map(function ($subscriber) use ($request) {
            return new \App\Jobs\SendNewsletterEmail($subscriber, $request->subject, $request->body);
        });

        Bus::batch($jobs->toArray())->onConnection('sync')->dispatch();

        return back()->with('success', 'Broadcast sent to ' . $subscribers->count() . ' subscribers.');
    }

    public function destroy(NewsletterSubscriber $subscriber)
    {
        $subscriber->delete();
        return back()->with('success', 'Subscriber removed.');
    }
}
