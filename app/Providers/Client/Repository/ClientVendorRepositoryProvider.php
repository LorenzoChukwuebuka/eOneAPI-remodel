<?php

namespace App\Providers\Client\Repository;

use Illuminate\Support\ServiceProvider;
use App\Repository\Client\ClientVendorRepository;
use App\Interface\IRepository\Client\IClientVendorRepository;

class ClientVendorRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IClientVendorRepository::class,ClientVendorRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
