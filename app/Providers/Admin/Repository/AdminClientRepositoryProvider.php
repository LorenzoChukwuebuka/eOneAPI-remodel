<?php

namespace App\Providers\Admin\Repository;

use Illuminate\Support\ServiceProvider;
use App\Repository\Admin\AdminClientRepository;
use App\Interface\IRepository\Admin\IAdminClientRepository;

class AdminClientRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IAdminClientRepository::class,AdminClientRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
