<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(20);
        return view('admin.messages.index', compact('messages'));
    }

    public function show(ContactMessage $message)
    {
        $message->update(['is_read' => true]);
        return view('admin.messages.show', compact('message'));
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Message deleted.');
    }

    public function toggleRead(ContactMessage $message)
    {
        $message->update(['is_read' => !$message->is_read]);
        return back()->with('success', $message->is_read ? 'Marked as read.' : 'Marked as unread.');
    }

    public function reply(Request $request, ContactMessage $message)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        $adminEmail = config('app.admin_email', config('mail.from.address'));

        Mail::raw($request->reply, function ($mail) use ($message, $adminEmail) {
            $mail->to($message->email)
                ->subject('Re: ' . $message->name . ' - Contact Message')
                ->from($adminEmail, config('app.name', 'Irminsul Studio'));
        });

        return back()->with('success', 'Reply sent to ' . $message->email . '.');
    }
}
