<?php

namespace App\Providers\Admin\Repository;

use App\Interface\IRepository\Admin\IAdminClientRepository;
use App\Repository\Admin\AdminClientRepository;
use Illuminate\Support\ServiceProvider;

class AdminClientRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IAdminClientRepository::class, AdminClientRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
