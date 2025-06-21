<?php

namespace App\Console\Commands;


use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\SendEventReminders;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('events:send-reminders')->dailyAt('08:00');
    }
}
