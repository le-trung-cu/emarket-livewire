<?php

use App\Http\Controllers\AddressController;
use App\Http\Livewire\Site\CartDetail;
use App\Http\Livewire\Site\Home;
use App\Http\Livewire\Site\ProductDetail;
use Illuminate\Support\Facades\Auth;
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


Route::get('/data', function () {
    dd(Auth::user());
})->middleware('auth');

Route::group(['as' => 'site.'], function () {
    Route::get('/', Home::class)->name('home');
    Route::get('products/{product}', ProductDetail::class)->name('product.show');
    Route::get('/cart', CartDetail::class)->name('cart.show');
});

Route::controller(AddressController::class)->prefix('/address')->as('address.')->group(function () {
    Route::get('provinces', 'provinces')->name('provinces');
    Route::get('districts', 'districts')->name('districts');
    Route::get('wards', 'wards')->name('wards');
});


Route::view('/powergrid', 'powergrid-demo');
require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
