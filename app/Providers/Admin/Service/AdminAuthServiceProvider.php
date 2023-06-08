<?php

namespace App\Providers\Admin\Service;

use App\Interface\IService\Admin\IAdminAuthService;
use App\Services\Admin\AdminAuthService;
use Illuminate\Support\ServiceProvider;

class AdminAuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IAdminAuthService::class, AdminAuthService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
