<?php

namespace App\Providers\Client\Service;


use Illuminate\Support\ServiceProvider;
use App\Services\Client\ClientVendorService;
use App\Interface\IService\Client\IClientVendorService;

class ClientVendorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IClientVendorService::class,ClientVendorService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
