<?php

namespace App\Providers\Vendor\Service;

use Illuminate\Support\ServiceProvider;
use App\Services\Vendor\VendorAuthService;
use App\Interface\IService\Vendor\IVendorAuthService;

class VendorAuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IVendorAuthService::class,VendorAuthService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
