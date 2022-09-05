<?php

use App\Http\Controllers\Api\AuthController;
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

Route::apiResource('/users', 'App\Http\Controllers\Api\UserController');

Route::post('/file/upload', ['App\Http\Controllers\Api\FileController', 'upload']);

Route::post('/token',[AuthController::class, 'token']);

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::get('/tokenVerification', function () {
        return 'ok';
    });
});
