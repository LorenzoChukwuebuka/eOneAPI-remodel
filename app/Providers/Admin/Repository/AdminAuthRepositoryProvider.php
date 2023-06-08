<?php

namespace App\Providers\Admin\Repository;

use Illuminate\Support\ServiceProvider;
use App\Repository\Admin\AdminAuthRepository;
use App\Interface\IRepository\Admin\IAdminAuthRepository;
 

class AdminAuthRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IAdminAuthRepository::class,AdminAuthRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
