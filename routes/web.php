<?php

use App\Http\Livewire\Site\Home;
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

Route::group(['as' => 'site'], function() {
    Route::get('/', Home::class)->name('home');
});


Route::view('/powergrid', 'powergrid-demo');
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';