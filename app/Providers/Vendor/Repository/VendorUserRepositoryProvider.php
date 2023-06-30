<?php

namespace App\Providers\Vendor\Repository;

use Illuminate\Support\ServiceProvider;
use App\Repository\Vendor\VendorUserRepository;
use App\Interface\IRepository\Vendor\IVendorUserRepository;

class VendorUserRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IVendorUserRepository::class,VendorUserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
