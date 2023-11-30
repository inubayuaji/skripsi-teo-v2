<?php

use App\Http\Controllers\Actions;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\WebPageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PhpParser\Builder\Function_;

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

Route::controller(WebPageController::class)
    ->name('web.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        // Route::get('/', 'index')->name('index');
        Route::get('/about', 'about')->name('about');
        Route::get('/contact', 'contact')->name('contact');
        Route::get('/shop-single/{id}', 'shopSingle')->name('shop-single');
        Route::get('/login', 'login')->name('auth.login');
        Route::get('/register', 'register')->name('auth.register');
    });
Route::controller(WebPageController::class)
    ->name('web.')
    ->middleware('auth:customer')
    ->group(function() {
        Route::get('/cart', 'cart')->name('cart');
    });

// ations
Route::post('/contact-form', Actions\StoreContactForm::class)
    ->name('action.store_contact_form');
Route::controller(Actions\AuthCustomerController::class)
    ->name('action.')
    ->group(function() {
        Route::post('/register', 'register')->name('register_customer');
        Route::post('/login', 'login')->name('login_customer');
        Route::get('/logout', 'logout')->name('logout_customer');
    });
Route::middleware('auth:customer')
    ->group(function() {
        Route::controller(Actions\CartController::class)
            ->name('action.')
            ->group(function () {
                Route::get('/cart/add', 'add')->name('cart_add');
                Route::get('/cart/update', 'update')->name('cart_update');
                Route::get('/cart/delete', 'delete')->name('cart_delete');
            });

        Route::post('/cakeout', Actions\CakeoutOrderController::class)
            ->name('action.cakeout');

        Route::controller(CustomerController::class)
            ->name('web.customer.')
            ->prefix('/customer')
            ->group(function () {
                Route::get('/profil', 'profil')->name('profil');
                Route::get('/order', 'order')->name('order');
            });
     });
