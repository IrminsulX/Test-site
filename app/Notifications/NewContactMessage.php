<?php
namespace App\Notifications;
use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewContactMessage extends Notification
{
    use Queueable;

    public ContactMessage $message;

    public function __construct(ContactMessage $message)
    {
        $this->message = $message;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Contact Message: ' . $this->message->subject ?? 'No Subject')
            ->greeting('New message from ' . $this->message->name)
            ->line('Email: ' . $this->message->email)
            ->lineIf($this->message->company, 'Company: ' . $this->message->company)
            ->line('Message:')
            ->line($this->message->message)
            ->action('View in Admin', url('/admin/messages/' . $this->message->id));
    }
}
