<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Card\CardHistoryService;
use App\Interface\IService\Card\ICardHistoryService;

class CardHistoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ICardHistoryService::class,CardHistoryService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
