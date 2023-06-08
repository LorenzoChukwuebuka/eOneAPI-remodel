<?php

use App\Http\Controllers\Admin\AdminAuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin_restricted')->group(function () {

    #roles
    Route::controller(AdminAuthController::class)->group(function () {
        Route::post('login', 'login');
        // Route::get('get_all_roles', 'get_roles');
        // Route::put('edit_roles/{id}', 'edit_roles');
        // Route::delete('delete_role/{id}', 'delete_roles');
    });

  //  Route::group(['middleware' => ['auth:admin,admin-api']], function () {});
});
