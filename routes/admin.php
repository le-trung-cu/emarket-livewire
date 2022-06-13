<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Livewire\Admin\CategoryList;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::group(['middleware' => 'auth:admin'], function(){
        Route::get('/dashboard', function(){
            return view('dashboard');
        })->name('dashboard');

        Route::get('/categories', CategoryList::class)->name('categories.index');
    });
});
