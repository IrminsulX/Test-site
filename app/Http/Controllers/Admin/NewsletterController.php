<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        $subscribers = NewsletterSubscriber::pluck('email');

        if ($subscribers->isEmpty()) {
            return back()->with('error', 'No subscribers to send to.');
        }

        foreach ($subscribers as $email) {
            Mail::raw($request->body, function ($message) use ($email, $request) {
                $message->to($email)
                    ->subject($request->subject);
            });
        }

        return back()->with('success', 'Broadcast sent to ' . $subscribers->count() . ' subscribers.');
    }
}
