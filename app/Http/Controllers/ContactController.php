<?php
namespace App\Http\Controllers;
use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewContactMessage;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'company' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $message = ContactMessage::create($data);

        try {
            $admins = User::where('is_admin', true)->get();
            if ($admins->count()) {
                Notification::send($admins, new NewContactMessage($message));
            }
        } catch (\Exception $e) {
            Log::warning('Could not send email notification: ' . $e->getMessage());
        }

        return redirect()->route('contact')->with('success', 'Message sent! We\'ll get back to you soon.');
    }
}
