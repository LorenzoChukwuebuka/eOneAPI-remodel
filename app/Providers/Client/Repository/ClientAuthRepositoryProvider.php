<?php

namespace App\Providers\Client\Repository;

use App\Interface\IRepository\Client\IClientRepository;
use App\Repository\Client\ClientRepository;
use Illuminate\Support\ServiceProvider;

class ClientAuthRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IClientRepository::class, ClientRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
