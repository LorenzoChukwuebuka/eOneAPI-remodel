<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Card\CardHistoryRepository;
use App\Interface\IRepository\Card\ICardHistoryRepository;

class CardHistoryRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ICardHistoryRepository::class,CardHistoryRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
