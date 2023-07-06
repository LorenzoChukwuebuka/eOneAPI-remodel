<?php

use App\Http\Controllers\Card\CardController;
use App\Http\Controllers\Vendor\VendordAuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('vendor_restricted')->group(function () {

    Route::post('verify-vendor', [VendordAuthController::class, 'verifyVendor']);

    Route::post('vendor-login', [VendordAuthController::class, 'login']);

    // Route::get('get-account-type', [CardController::class, '']);
    // Route::get('get-card-type', [CardController::class, '']);

    Route::group(['middleware' => ['auth:vendor,vendor-api']], function () {
        Route::controller(CardController::class)->group(function () {
            Route::post('create-users-card', 'create_card_for_users');
        });
    });

});
