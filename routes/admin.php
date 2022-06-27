<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Livewire\Admin\CategoryList;
use App\Http\Livewire\Admin\OrderList;
use App\Http\Livewire\Admin\ProductDetail;
use App\Http\Livewire\Admin\ProductList;
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
        Route::get('dashboard', function(){
            return view('dashboard');
        })->name('dashboard');

        Route::get('categories', CategoryList::class)->name('categories.index');

        Route::get('products/{product}', ProductDetail::class)->name('product.show');
        Route::get('products', ProductList::class)->name('product.index');
        
        Route::get('orders', OrderList::class)->name('orders.index');
    });
});
