<?php

use App\Http\Controllers\Admin\AdminAuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin_restricted')->group(function () {

    #roles
    Route::controller(AdminAuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('forgetpassword', 'forgotpassword');
        Route::post('resetpassword', 'resetpassword');

    });

    Route::group(['middleware' => ['auth:admin,admin-api']], function () {
        Route::post('changepassword', [AdminAuthController::class, 'changePassword']);
    });
});
