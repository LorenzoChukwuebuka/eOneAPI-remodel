<?php

namespace App\Providers\Vendor\Repository;

use Illuminate\Support\ServiceProvider;
use App\Repository\Vendor\VendorAuthRepository;
use App\Interface\IRepository\Vendor\IVendorAuthRepository;

class VendorAuthRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IVendorAuthRepository::class,VendorAuthRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
