<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Admin\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['namespace' => 'App\Http\Controllers\Users', 'prefix' => 'list'], function () {
    Route::resource('users', 'App\Http\Controllers\Users\UserController')->names('list.users');
});

Route::group(['namespace' => 'App\Http\Controllers\Web\Admin', 'prefix' => 'admin'], function (){
    Route::resource('profile', ProfileController::class)
        ->only('index', 'edit', 'update', 'destroy')
        ->names('admin.profile');
});
