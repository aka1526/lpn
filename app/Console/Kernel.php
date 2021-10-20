<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\CronJobSendMailSubscribe::class
       
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
       //  $schedule->command('CronJobSendMailSubscribe')->everyTenMinutes(); //10 นาที่
        $schedule->command('SendMailSubscribe')->everyTwoMinutes(); //2 นาที่
      //  $schedule->exec("php artisan schedule:run >> schedule_logs.log")->everyTwoMinutes(); //2 นาที่
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
