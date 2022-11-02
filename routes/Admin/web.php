<?php

use App\Http\Controllers\Admin\Properties\PropertyController;
use App\Http\Controllers\Admin\Properties\PropertyTypeController;
use App\Http\Controllers\Admin\Setup\TypeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
        Route::controller(PropertyController::class)->prefix('properties/')->name('properties.')->group(function(){
            Route::get('/', 'index')->name('index') ;
            Route::get('/api', 'apiProperties')->name('api') ;
            Route::get('/api/refresh', 'getApiProperties')->name('api_refresh') ;
            Route::get('/create', 'create')->name('create') ;
            Route::get('/{property}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::put('/{property}', 'update')->name('update');
            Route::delete('/{property}', 'destroy')->name('destroy');
        });

        Route::controller(PropertyTypeController::class)->prefix('property-types/')->name('property_types.')->group(function(){
            Route::get('/', 'index')->name('index') ;
            Route::get('/create', 'create')->name('create') ;
            Route::get('/{propertyType}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::put('/{propertyType}', 'update')->name('update');
            Route::delete('/{propertyType}', 'destroy')->name('destroy');
        });
});
