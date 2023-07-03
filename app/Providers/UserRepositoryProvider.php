<?php

namespace App\Providers;

use App\Repository\User\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Interface\IRepository\User\IUserRepository;

class UserRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class,UserRepository::Class); 
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
