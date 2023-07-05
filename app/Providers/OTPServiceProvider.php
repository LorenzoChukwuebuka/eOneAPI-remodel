<?php

namespace App\Providers;

use App\Interface\IService\IOTPService;
use App\Services\OTPService;
use Illuminate\Support\ServiceProvider;

class OTPServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IOTPService::class, OTPService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
