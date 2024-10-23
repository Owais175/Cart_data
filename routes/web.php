<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\taxController;
use App\Http\Controllers\Cartcantroller;
use App\Http\Controllers\Pagecontroller;
use App\Http\Controllers\Pymentcontroller;
use App\Http\Controllers\Couponscontroller;
use App\Http\Controllers\Productcontroller;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AttributesController;
use App\Http\Controllers\AttributesvaluesController;

// page route
Route::get('/', [Pagecontroller::class, 'index'])->name('index');
Route::get('productdetails/{id}', [Pagecontroller::class, 'details'])->name('productdetails');

// products crud route
Route::get('product/index', [Productcontroller::class, 'index'])->name('product.index');
Route::get('product/create', [Productcontroller::class, 'create'])->name('product.create');
Route::post('product/store', [Productcontroller::class, 'store'])->name('product.store');
Route::get('product/edit/{id}', [Productcontroller::class, 'edit'])->name('product.edit');
Route::post('product/update/{id}', [Productcontroller::class, 'update'])->name('product.update');
Route::delete('product/delete/{id}', [Productcontroller::class, 'destroy'])->name('product.delete');

// search route
Route::get('search', [Pagecontroller::class, 'index'])->name('search');

// attributes route
Route::get('attributes/index', [AttributesController::class, 'index'])->name('attributes.index');
Route::get('attributes/create', [AttributesController::class, 'create'])->name('attributes.create');
Route::post('attributes/store', [AttributesController::class, 'store'])->name('attributes.store');
Route::get('attributes/edit/{id}', [AttributesController::class, 'edit'])->name('attributes.edit');
Route::post('attributes/update/{id}', [AttributesController::class, 'update'])->name('attributes.update');
Route::delete('attributes/delete/{id}', [AttributesController::class, 'destroy'])->name('attributes.delete');

// attributesvalues route
Route::get('attributesvalues/index', [AttributesvaluesController::class, 'index'])->name('attributesvalues.index');
Route::get('attributesvalues/create', [AttributesvaluesController::class, 'create'])->name('attributesvalues.create');
Route::post('attributesvalues/store', [AttributesvaluesController::class, 'store'])->name('attributesvalues.store');
Route::get('attributesvalues/edit/{id}', [AttributesvaluesController::class, 'edit'])->name('attributesvalues.edit');
Route::post('attributesvalues/update/{id}', [AttributesvaluesController::class, 'update'])->name('attributesvalues.update');
Route::delete('attributesvalues/delete/{id}', [AttributesvaluesController::class, 'destroy'])->name('attributesvalues.delete');

// carts route
Route::get('cart/cart', [Cartcantroller::class, 'cart'])->name('cart.cart');
Route::get('Addcart', [Cartcantroller::class, 'savecart'])->name('savecart');
Route::get('getcart', [Cartcantroller::class, 'getcart'])->name('getcart');
Route::get('removecart/{id}', [Cartcantroller::class, 'removecart'])->name('removecart');

// payment route
Route::get('checkout', [Pymentcontroller::class, 'checkout'])->name('cart.checkout');
Route::post('ordercart', [Pymentcontroller::class, 'ordercart'])->name('ordercart');

// coupons route
Route::get('coupons', [Couponscontroller::class, 'index'])->name('Coupons.index');
Route::get('coupons/create', [Couponscontroller::class, 'create'])->name('Coupons.create');
Route::post('coupons/store', [Couponscontroller::class, 'store'])->name('Coupons.store');
Route::get('coupons/edit/{id}', [Couponscontroller::class, 'edit'])->name('Coupons.edit');
Route::post('coupons/update/{id}', [Couponscontroller::class, 'update'])->name('Coupons.update');
Route::post('/couponsapply', [Cartcantroller::class, 'coupons'])->name('couponsapply');

// coupons route
Route::get('tax', [TaxController::class, 'index'])->name('tax.index');
Route::get('tax/create', [TaxController::class, 'create'])->name('tax.create');
Route::post('tax/store', [TaxController::class, 'store'])->name('tax.store');
Route::get('tax/edit/{id}', [TaxController::class, 'edit'])->name('tax.edit');
Route::post('tax/update/{id}', [TaxController::class, 'update'])->name('tax.update');


// account route
Route::get('account/signup', [RegisterController::class, 'signup'])->name('account.signup');
Route::post('account/signin', [RegisterController::class, 'signin'])->name('account.signin');
Route::post('account/login', [RegisterController::class, 'loginuser'])->name('account.login');
Route::get('dashboard', [RegisterController::class, 'dashboard'])->name('account.dashboard');
Route::get('logout', [RegisterController::class, 'logout'])->name('logout');
Route::get('sidebar', [RegisterController::class, 'sidebar'])->name('sidebar');
Route::get('account/details', [RegisterController::class, 'accountdetails'])->name('account.account-details');
Route::post('account/update-account', [RegisterController::class, 'updateaccount'])->name('account.updateaccount');
