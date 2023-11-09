<?php

namespace App\Console;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        'App\Console\Commands\NotificationBirdayDoctor'
    ];
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('app:notification-birday-doctor')->everyMinute();
        //        $schedule->command('app:notification-birday-doctor')->dailyAt('12:00');
        
        // $schedule->call(function () {
        //     DB::table('personal_access_tokens')->where('created_at', '<', now()->subDays(1))->delete();
        // })->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
