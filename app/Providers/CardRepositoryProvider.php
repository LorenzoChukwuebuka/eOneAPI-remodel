<?php

namespace App\Providers;

use App\Repository\Card\CardRepository;
use Illuminate\Support\ServiceProvider;
use App\Interface\IRepository\Card\ICardRepository;

class CardRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ICardRepository::class,CardRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
