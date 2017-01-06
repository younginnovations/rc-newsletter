<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\SendEmail',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $frequency = DB::table('settings')->select('value')->where('key', 'schedule')->first();
        $time      = DB::table('settings')->select('value')->where('key', 'time')->first();

        if ($frequency->value == "DAILY") {
            $schedule->command('newsletter:send')->dailyAt($time->value.":00");
        } elseif ($frequency->value == "WEEKLY") {
            $schedule->command('newsletter:send')->weeklyOn(1, $time->value.":00");
        }
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
