<?php

namespace App\Providers\Vendor\Service;

use Illuminate\Support\ServiceProvider;
use App\Services\Vendor\VendorUserService;
use App\Interface\IService\Vendor\IVendorUserService;

class VendorUserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IVendorUserService::class,VendorUserService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
