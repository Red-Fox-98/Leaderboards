<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PlayerController;
use App\Http\Controllers\Api\SessionController;

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

Route::group(['prefix' => 'auth'], function (){
    Route::post('/login', [AuthController::class, 'login'])->name('api.auth.login');
});

Route::group(['prefix' => 'sessions', 'as' => 'sessions.', 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('/', SessionController::class)->only('store');
});

Route::apiResource('/sessions', SessionController::class)->only('index');
