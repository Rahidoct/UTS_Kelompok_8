<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BuyNowController;
use App\Http\Controllers\productController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\TransactionController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::middleware(['auth'])->group(function () {
  Route::get('/', [HomeController::class, 'index'])->name('beranda');
  Route::get('/products/category/{categoryId}', [HomeController::class, 'showProductsByCategory']);
  Route::resource('categories', categoryController::class);
  Route::resource('products', productController::class);
  Route::get('/cart', [cartController::class, 'index'])->name('carts.index');
  Route::post('/cart/add', [cartController::class, 'addToCart'])->name('addToCart');
  Route::put('/carts/{cart}', [cartController::class, 'update'])->name('carts.update');
  Route::delete('/carts/{cart}', [cartController::class, 'destroy'])->name('carts.destroy');
  // Route::post('/checkout', 'CheckoutController@checkout')->name('checkout');
  Route::post('/buy-now', [BuyNowController::class, 'buyNow'])->name('buyNow');
  Route::get('/invoice/{transaction_id}', [TransactionController::class, 'showInvoice'])->name('invoice');
  Route::get('/transactions', [TransactionController::class, 'transaction'])->name('transactions');

});