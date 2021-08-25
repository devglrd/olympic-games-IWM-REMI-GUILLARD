<?php

use App\Http\Controllers\App\StaticsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => '', 'namespace' => 'App'], function () {
    Route::get('/', [\App\Http\Controllers\App\StaticsController::class, 'home']);
    Route::post('/', [\App\Http\Controllers\App\StaticsController::class, 'store']);

});


Route::get('/login', [\App\Http\Controllers\App\StaticsController::class, 'loginView'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [StaticsController::class, 'login'])
    ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
