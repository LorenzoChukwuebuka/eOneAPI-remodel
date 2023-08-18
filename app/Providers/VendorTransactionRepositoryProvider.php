<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Transactions\VendorTransactionRepository;
use App\Interface\IRepository\Vendor\IVendorTransactionRepository;

class VendorTransactionRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IVendorTransactionRepository::class,VendorTransactionRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
