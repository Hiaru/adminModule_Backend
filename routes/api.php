<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * CONTROLLERS
 */
use App\Http\Controllers\auth\loginController;
use App\Http\Controllers\managerController;
use App\Http\Controllers\usersDatabasesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login', [loginController::class, 'login']);

Route::post('new', [loginController::class, 'test']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('get_all_users_with_roles', [managerController::class, 'all_users_with_roles']);

    Route::post('/get_roles_by_user', [managerController::class, 'get_roles_by_user']);

    Route::post('/get_permissions_by_user', [managerController::class, 'get_permissions_by_user']);

    Route::post('/update_roles_by_user', [managerController::class, 'update_roles_by_user']);

    Route::post('/update_user_status', [managerController::class, 'update_user_status']);

    Route::post('/get_all_roles', [managerController::class, 'get_all_roles']);

    Route::post('/get_all_permissions', [managerController::class, 'get_all_permissions']);

    Route::get('/logout', [loginController::class, 'logout']);

    /**
     * CONFIG
     */
    Route::get('/get_databases_names', [usersDatabasesController::class, 'get_databases_names']);
});

