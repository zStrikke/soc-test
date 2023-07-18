<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])
        ->controller(UserController::class)
        ->prefix('users')
        ->name('user.')
        ->group(function(){
            Route::POST('register', 'registerUser')->name('register');
            Route::PUT('/{user}', 'updateUser')->name('update');
            Route::DELETE('/{user}', 'deleteUser')->name('delete');
            Route::POST('{user}/store-result', 'storeResult')->name('store-result');
        });