<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminClientController;
use App\Http\Controllers\Admin\AdminVendorController;
use App\Http\Controllers\User\UserController;
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

        #admin client
        Route::controller(AdminClientController::class)->group(function () {
            Route::post('create_client', 'createClient');
            Route::get('get_all_clients', 'getAllClients');
            Route::get('get_single_client/{id}', 'getSingleClient');
            Route::put('update_client/{id}', 'updateClient');
            Route::delete('delete_client/{id}', 'deleteClient');
        });

        #admin vendor
        Route::controller(AdminVendorController::class)->group(function () {
            Route::post('create_vendor', 'createVendor');
            Route::get('get_all_vendors', 'getAllVendors');
            Route::get('get_single_vendor/{id}', 'getSingleVendor');
            Route::put('update_vendor/{id}', 'updateVendor');
            Route::delete('delete_vendor/{id}', 'deleteVendor');
        });

        Route::controller(UserController::class)->group(function () {
            Route::post('create-user', 'create_user');
            Route::get('get-all-users', 'get_all_users');
            Route::get('get-single-user/{id}', 'get_single_user');
            Route::put('edit-user/{id}', 'edit_user');
            Route::delete('delete-user/{id}','delete_user');
            Route::post('search-users','search_users');
        });

    });
});
