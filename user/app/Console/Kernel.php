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
        Commands\BalanceTRXUpdate::class,
        Commands\LivePriceUpdate::class,
        Commands\UpdateBankExpired::class,
        Commands\UpdateLivePrizeDextrade::class,
        Commands\LivePriceUpdateSwap::class,
        Commands\ByBitLivePriceUpdate::class,

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('update:tradeprice')->everyFiveMinutes()->withoutOverlapping();
        $schedule->command('update:Swapliveprice')->everyMinute()->withoutOverlapping();
        $schedule->command('update:liveprice')->everyMinute()->withoutOverlapping();
        $schedule->command('update:bybitliveprice')->everyMinute()->withoutOverlapping();

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
