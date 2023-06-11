<?php

namespace App\Providers\Admin\Service;

use Illuminate\Support\ServiceProvider;
use App\Services\Admin\AdminVendorService;
use App\Interface\IService\Admin\IAdminVendorService;

class AdminVendorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IAdminVendorService::class,AdminVendorService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
