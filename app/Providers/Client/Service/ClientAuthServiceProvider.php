<?php

namespace App\Providers\Client\Service;

use App\Services\Client\ClientService;
use Illuminate\Support\ServiceProvider;
use App\Interface\IService\Client\IClientService;

class ClientAuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IClientService::class,ClientService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
