<?php

use App\Http\Controllers\AddressController;
use App\Http\Livewire\Site\CartDetail;
use App\Http\Livewire\Site\Checkout;
use App\Http\Livewire\Site\CheckoutSuccess;
use App\Http\Livewire\Site\Home;
use App\Http\Livewire\Site\ProductDetail;
use App\Http\Livewire\Site\VNPaymentSuccess;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
    Route::get('checkout', Checkout::class)->name('checkout');
    Route::middleware('signed')->get('checkout-success/{order}', CheckoutSuccess::class)->name('checkout-success');

    Route::get('vnpayment-success', VNPaymentSuccess::class)->name('vnpayment-success');
});

Route::controller(AddressController::class)->prefix('/address')->as('address.')->group(function () {
    Route::get('provinces', 'provinces')->name('provinces');
    Route::get('districts', 'districts')->name('districts');
    Route::get('wards', 'wards')->name('wards');
});

Route::get('/test', function() {
    $product = Product::find(4);
    // $product = new Product();
    $product->addMedia(storage_path('test-image/10.jpg'))
    ->preservingOriginal()
    ->toMediaCollection('product-thumbnail');
    // Product::find(5)->addMediaF($media)->toMediaCollection('preview');
});

Route::view('/powergrid', 'powergrid-demo');
require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
