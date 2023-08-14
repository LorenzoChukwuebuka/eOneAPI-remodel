<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Services\Transactions\PaymentService;
use App\Interface\IService\Card\IPaymentService;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IPaymentService::class,PaymentService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
