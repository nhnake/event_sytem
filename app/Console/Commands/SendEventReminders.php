<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class SendEventReminders extends Command
{
    protected $signature = 'events:send-reminders';
    protected $description = 'Send notifications to users for events happening tomorrow';

    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->startOfDay();
        $events = Event::whereDate('start_time', $tomorrow)->with('participants')->get();

        foreach ($events as $event) {
            foreach ($event->participants as $user) {
                $user->notify(new \App\Notifications\EventReminderNotification($event));
            }
        }

        $this->info('Event reminders sent!');
    }
}
