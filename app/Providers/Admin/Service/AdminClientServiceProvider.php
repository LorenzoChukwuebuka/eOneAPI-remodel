<?php

namespace App\Providers\Admin\Service;

use App\Interface\IService\Admin\IAdminClientService;
use App\Services\Admin\AdminClientService;
use Illuminate\Support\ServiceProvider;

class AdminClientServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IAdminClientService::class, AdminClientService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
