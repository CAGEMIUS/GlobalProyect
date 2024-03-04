<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
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
})->name('welcome');;

Route::get('/service', function () {
    return view('layouts.service');
})->name('service');


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


require __DIR__.'/auth.php';
