<?php

namespace App\Providers;

use App\Services\Card\PaymentService;
use Illuminate\Support\ServiceProvider;
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
