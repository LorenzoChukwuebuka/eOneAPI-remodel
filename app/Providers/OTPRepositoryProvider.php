<?php

namespace App\Providers;

use App\Interface\IRepository\IOTPRepository;
use App\Repository\OTPRepository;
use Illuminate\Support\ServiceProvider;

class OTPRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IOTPRepository::class, OTPRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
