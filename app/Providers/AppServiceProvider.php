<?php

namespace App\Providers;

use App\Http\View\Composers\NotificationComposer;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        Carbon::setLocale('id');
        CarbonInterval::setLocale('id');

        // For tutor notif
        view()->composer('*', NotificationComposer::class);

        // storage link
        if (app()->runningInConsole()) {
            return;
        }

        $storageLink = public_path('storage');

        if (!is_link($storageLink)) {
            try {
                Artisan::call('storage:link');
            } catch (\Throwable $e) {
                Log::error($e);
            }
        }
    }
}
