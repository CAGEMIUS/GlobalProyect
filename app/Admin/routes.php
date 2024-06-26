<?php

use App\Admin\Controllers\EmpresaController;
use App\Admin\Controllers\ProductController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use OpenAdmin\Admin\Facades\Admin;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('products', ProductController::class);
    $router->resource('empresas', EmpresaController::class);
    $router->resource('buyers', BuyerController::class);
    $router->resource('product-pays', ProductPayController::class);
    $router->resource('payments', PaymentController::class);
    $router->resource('estados', EstadoController::class);
    $router->resource('mercado-pagos', MercadoPagoController::class);
    
});
