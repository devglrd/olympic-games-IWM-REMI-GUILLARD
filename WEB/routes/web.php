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

Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'dashboard']);
    Route::get('/logout', [\App\Http\Controllers\Admin\AdminController::class, 'logout']);

    Route::group(['prefix' => 'sports'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\SportController::class, 'index']);
        Route::get('/create', [\App\Http\Controllers\Admin\SportController::class, 'create']);
        Route::post('/create', [\App\Http\Controllers\Admin\SportController::class, 'store']);
        Route::get('/edit/:slug', [\App\Http\Controllers\Admin\SportController::class, 'edit']);
        Route::post('/edit/:slug', [\App\Http\Controllers\Admin\SportController::class, 'update']);
        Route::post('/delete/:slug', [\App\Http\Controllers\Admin\SportController::class, 'delete']);
    });

    Route::group(['prefix' => 'sports'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\SportController::class, 'index']);
        Route::get('/create', [\App\Http\Controllers\Admin\SportController::class, 'create']);
        Route::post('/create', [\App\Http\Controllers\Admin\SportController::class, 'store']);
        Route::get('/edit/{slug}', [\App\Http\Controllers\Admin\SportController::class, 'edit']);
        Route::post('/edit/{slug}', [\App\Http\Controllers\Admin\SportController::class, 'update']);
        Route::post('/delete/{slug}', [\App\Http\Controllers\Admin\SportController::class, 'delete']);
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\EventCategoryController::class, 'index']);
        Route::get('/create', [\App\Http\Controllers\Admin\EventCategoryController::class, 'create']);
        Route::post('/create', [\App\Http\Controllers\Admin\EventCategoryController::class, 'store']);
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\EventCategoryController::class, 'edit']);
        Route::post('/edit/{id}', [\App\Http\Controllers\Admin\EventCategoryController::class, 'update']);
        Route::post('/delete/{id}', [\App\Http\Controllers\Admin\EventCategoryController::class, 'delete']);
    });

    Route::group(['prefix' => 'event'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\EventController::class, 'index']);
        Route::get('/create', [\App\Http\Controllers\Admin\EventController::class, 'create']);
        Route::post('/create', [\App\Http\Controllers\Admin\EventController::class, 'store']);
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\EventController::class, 'edit']);
        Route::post('/edit/{id}', [\App\Http\Controllers\Admin\EventController::class, 'update']);
        Route::post('/delete/{id}', [\App\Http\Controllers\Admin\EventController::class, 'delete']);
    });

});


Route::get('/login', [\App\Http\Controllers\App\StaticsController::class, 'loginView'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [StaticsController::class, 'login'])
    ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
