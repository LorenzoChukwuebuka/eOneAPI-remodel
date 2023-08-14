<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Transactions\CardTransactionRepository;
use App\Interface\IRepository\Card\ICardTransactionRepository;

class CardTransactionRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ICardTransactionRepository::class, CardTransactionRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
