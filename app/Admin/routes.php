<?php

use Illuminate\Routing\Router;
use OpenAdmin\Admin\Facades\Admin;
use Illuminate\Support\Facades\Route;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('products', ProductController::class);
    $router->resource('customers', CustomerController::class)
        ->only(['index', 'show', 'destroy']);
    $router->resource('orders', OrderController::class);
        // ->only(['index', 'show', 'destroy']);
    $router->resource('contact-forms', ContactFormController::class)
        ->only(['index', 'show', 'destroy']);
    $router->resource('purchases', PurchaseController::class);
});
