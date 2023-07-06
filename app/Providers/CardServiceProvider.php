<?php

namespace App\Providers;

use App\Services\Card\CardService;
use Illuminate\Support\ServiceProvider;
use App\Interface\IService\Card\ICardService;

class CardServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ICardService::class,CardService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
