<?php

namespace App\Providers;

use UserService;
use Illuminate\Support\ServiceProvider;
use App\Interface\IService\User\IUserService;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IUserService::class,UserService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
