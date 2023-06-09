<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminClientController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin_restricted')->group(function () {

    #admin auth route
    Route::controller(AdminAuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('forgetpassword', 'forgotpassword');
        Route::post('resetpassword', 'resetpassword');

    });

    Route::group(['middleware' => ['auth:admin,admin-api']], function () {
        Route::post('changepassword', [AdminAuthController::class, 'changePassword']);

        Route::controller(AdminClientController::class)->group(function () {
            Route::post('create_client', 'createClient');
            Route::get('get_all_clients', 'getAllClients');
            Route::get('get_single_client/{id}', 'getSingleClient');
            Route::put('update_client/{id}', 'updateClient');
            Route::delete('delete_client/{id}', 'deleteClient');
        });

    });
});
