<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\ProfileController;
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

Route::apiResource('/users', UserController::class)
    ->only('index');

Route::group(['prefix' => 'auth'], function (){
    Route::post('/login', [AuthController::class, 'login'])->name('api.auth.login');
    Route::post('/register', [AuthController::class, 'register'])->name('api.auth.register');
});

Route::group(['prefix' => 'players', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/', [PlayerController::class, 'create'])->name('api.player.create');
});

Route::group(['prefix' => 'sessions', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/', [SessionController::class, 'create'])->name('api.session.create');
    Route::apiResource('/', SessionController::class)->only('index');
});




//Route::group(['middleware' => 'auth:sanctum'], function () {
//    Route::get('/tokenVerification', function () {
//        return 'ok';
//    });
//    Route::apiResource('/profile', ProfileController::class)
//        ->only('create');
//    Route::post('/file/upload', [FileController::class, 'upload']);
//});
