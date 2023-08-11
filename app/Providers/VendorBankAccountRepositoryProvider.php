<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Vendor\VendorBankAccountRepository;
use App\Interface\IRepository\Vendor\IVendorBankAccountRepository;

class VendorBankAccountRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IVendorBankAccountRepository::class,VendorBankAccountRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
