<?php

namespace App\Providers;

 
use Illuminate\Support\ServiceProvider;
use App\Interface\IRepository\Card\IPaymentRepository;

class PaymentRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IPaymentRepository::class,PaymentRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
