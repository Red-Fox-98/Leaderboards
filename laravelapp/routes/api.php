<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
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

Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', [AuthController::class, 'register']);


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/player/create', [PlayerController::class, 'create']);

    Route::post('/session/create', [SessionController::class, 'create']);

    Route::get('/tokenVerification', function () {
        return 'ok';
    });

    Route::apiResource('/profile', ProfileController::class)
        ->only('create');

    Route::post('/file/upload', [FileController::class, 'upload']);
});
