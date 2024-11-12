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
        Commands\CreateUserDetails::class,

		Commands\BalanceTRXUpdate::class,
        Commands\BalanceETHUpdate::class,
        Commands\BalanceBNBUpdate::class,
        Commands\BalanceBNBTokenUpdate::class,
        Commands\BalanceTokenUpdate::class,
        Commands\BalanceMATICUpdate::class,
        Commands\BalanceMATICTokenUpdate::class,
        Commands\BalanceUpdateEVMToken::class,        
		
        Commands\BNBColdWallet::class,
        Commands\MATICColdWallet::class,
        Commands\TRXColdWallet::class,
        Commands\TRXTokenColdWallet::class,
        Commands\TRXFeewalletMove::class,
        Commands\ETHColdWallet::class,

        Commands\WithdrawTRCUpdate::class,
        Commands\WithdrawTRXUpdate::class,
        Commands\WithdrawBNBTokenUpdate::class,
        Commands\WithdrawBNBUpdate::class,
        Commands\WithdrawETHTokenUpdate::class,
        Commands\WithdrawETHUpdate::class,
        Commands\WithdrawMATICUpdate::class,
        Commands\WithdrawMATICTokenUpdate::class,
        
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('create:userdetails')->everyMinute()->withoutOverlapping();
        $schedule->command('update:evmtoken')->everyFiveMinutes()->withoutOverlapping();
		$schedule->command('update:eth')->everyFiveMinutes()->withoutOverlapping();
        $schedule->command('update:token')->daily()->withoutOverlapping();
        $schedule->command('update:bnb')->everyFiveMinutes()->withoutOverlapping();
        $schedule->command('update:trx')->everyFiveMinutes()->withoutOverlapping();
        $schedule->command('update:matic')->everyFiveMinutes()->withoutOverlapping();
        $schedule->command('update:bsctoken')->daily()->withoutOverlapping();
        $schedule->command('update:polytoken')->daily()->withoutOverlapping();
        $schedule->command('coldwallet:bnb')->everyMinute()->withoutOverlapping();
        $schedule->command('coldwallet:matic')->everyMinute()->withoutOverlapping();
        $schedule->command('coldwallet:trx')->everyMinute()->withoutOverlapping();

        $schedule->command('withdraw:trx')->everyMinute()->withoutOverlapping();
        $schedule->command('withdraw:trc')->everyMinute()->withoutOverlapping();
        $schedule->command('withdraw:eth')->everyMinute()->withoutOverlapping();
        $schedule->command('withdraw:ethtoken')->everyMinute()->withoutOverlapping();
        $schedule->command('withdraw:bnb')->everyMinute()->withoutOverlapping();        
        $schedule->command('withdraw:bnbtoken')->everyMinute()->withoutOverlapping();
        $schedule->command('withdraw:matic')->everyMinute()->withoutOverlapping();
        $schedule->command('withdraw:polytoken')->everyMinute()->withoutOverlapping();
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
