<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Vendor\VendorBankAccountService;
use App\Interface\IService\Vendor\IVendorBankAccountService;

class VendorBankAccountServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IVendorBankAccountService::class,VendorBankAccountService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
