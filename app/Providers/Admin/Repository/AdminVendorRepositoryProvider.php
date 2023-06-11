<?php

namespace App\Providers\Admin\Repository;

use Illuminate\Support\ServiceProvider;
use App\Repository\Admin\AdminVendorRepository;
use App\Interface\IRepository\Admin\IAdminVendorRepository;

class AdminVendorRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IAdminVendorRepository::class,AdminVendorRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
