<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\MercadoPagoController;
use App\Http\Middleware\AuthenticateCheckout;
use App\Http\Middleware\AuthenticateCompletado;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Main page
Route::get('/', function () {
    return view('layouts.welcome');
})->name('welcome');

Route::get('/prueba', function () {
    return view('prueba');
})->name('prueba');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout')->middleware(AuthenticateCheckout::class);

Route::get('/service', function () {
    return view('layouts.service');
})->name('service');


Route::get('/checkcompra', function () {
    return view('checkcompra');
})->name('checkcompra')->middleware(AuthenticateCheckout::class);

Route::get('/checkoutpay', function () {
    return view('checkoutpay');
})->name('checkoutpay')->middleware(AuthenticateCheckout::class);

Route::get('/completado', function () {
    return view('completado');
})->name('completado')->middleware('auth.completado');

Route::get('/fallo', function () {
    return view('fallo');
})->name('fallo')->middleware(AuthenticateCheckout::class);


// login page
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Routes languagues
Route::get('/locale/{locale}', function ($locale) {
    // Obtener la lista de idiomas disponibles
    $available_locales = config('app.available_locales');

    //Verificar si el idioma que quiero establecer, esta en la lista
    if(isset($locale) && in_array($locale, $available_locales)){
        app()->setlocale($locale);
        session()->put('locale', $locale);
    }else{
        //Mostrar mensaje en caso de que no exista el idioma
        return "Lo setimos el idioma buscado no esta disponible";
    }
    //realizar una accion cuando el usuario cambie el idioma
    return back();
})->name('lang');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Routes shoping cart
Route::get('/shop', [CartController::class, 'shop'])->name('shop');
Route::get('/shop', [CartController::class, 'shop'])->name('shop');
Route::get('/cart', [CartController::class, 'cart'])->name('cart.index');
Route::post('/add', [CartController::class, 'add'])->name('cart.store');
Route::post('/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');



//Routas de la vistas de las empresas
Route::get('/Postobon', function () {
    return view('Empresas.Postobon');
})->name('Postobon');

Route::get('/RedBull', function () {
    return view('Empresas.RedBull');
})->name('RedBull');

Route::get('/Pepsi', function () {
    return view('Empresas.Pepsi');
})->name('Pepsi');

//Ruta para que se muestre los productos en la vista
Route::get('/Postobon', [CartController::class, 'postobon'])->name('Postobon');
Route::get('/pedidos', [CartController::class, 'pedidos'])->name('pedidos');
Route::get('/RedBull', [CartController::class, 'redbull'])->name('RedBull');
Route::get('/Pepsi', [CartController::class, 'pepsi'])->name('Pespsi');
Route::get('/Manantial', [CartController::class, 'manantial'])->name('Manantial');

Route::get('/checkcompra', [CartController::class, 'checkcompra'])->name('checkcompra')->middleware(AuthenticateCheckout::class);
Route::get('/checkoutpay', [CartController::class, 'checkoutpay'])->name('checkoutpay')->middleware(AuthenticateCheckout::class);
Route::get('/completado', [CartController::class, 'completado'])->name('completado')->middleware('auth.completado');



Route::get('/checkout', [PaymentController::class, 'index'])->name('checkout')->middleware(AuthenticateCheckout::class);;
Route::post('charge', [PaymentController::class, 'charge'])->name('charge');
Route::get('success', [PaymentController::class, 'success'])->name('success');
Route::get('error', [PaymentController::class, 'error'])->name('error');




Route::post('/guardar-datos', [BuyerController::class, 'store'])->name('datos.store');
Route::get('/checkout', [BuyerController::class, 'users'])->name('checkout')->middleware(AuthenticateCheckout::class);
Route::get('/checkcompra', [BuyerController::class, 'showCompras'])->name('checkcompra')->middleware(AuthenticateCheckout::class);






require __DIR__.'/auth.php';
