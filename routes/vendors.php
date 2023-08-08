<?php

use App\Http\Controllers\Card\CardController;
use App\Http\Controllers\Vendor\VendordAuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('vendor_restricted')->group(function () {

    Route::post('verify-vendor', [VendordAuthController::class, 'verifyVendor']);
    Route::post('vendor-login', [VendordAuthController::class, 'login']);
    Route::get('get-account-type', [CardController::class, 'get_account_type']);
    Route::get('get-card-type', [CardController::class, 'get_card_type']);
    Route::post('vendor-forget-password', [VendordAuthController::class, 'forgetPassword']);

    Route::group(['middleware' => ['auth:vendor,vendor-api']], function () {
        Route::controller(CardController::class)->group(function () {
            Route::post('create-users-card', 'create_card_for_users');
            Route::get('get-registered-cards-per-vendor', 'get_all_cards_for_a_particular_vendor');
            Route::get('get-user-card-details/{id}', 'get_user_card_details');

        });
    });

});
