<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Notification;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            if (auth()->check()) {
                $userId = auth()->user()->id;
                $notifications = Notification::where('uid', $userId)->orderBy('created_at', 'DESC')->get();
                $view->with('notificationsdt', $notifications);
            }
        });

        Schema::defaultStringLength(191);
    }
}
