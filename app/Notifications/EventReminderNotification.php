<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventReminderNotification extends Notification
{
    use Queueable;

    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function via($notifiable)
    {
        return ['mail']; // You can also add 'database', 'sms', etc.
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Event Reminder: ' . $this->event->title)
            ->line("Hi {$notifiable->name},")
            ->line("Don't forget! You're attending **{$this->event->title}** tomorrow.")
            ->line("Event starts at: {$this->event->start_time}")
            ->line('See you there!');
    }
}
