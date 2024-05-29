<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buyer;
use App\Models\Product;
use App\Models\User;
use App\Models\ProductPay;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart; 

class BuyerController extends Controller
{
    // Método para obtener la lista de usuarios y mostrar en la vista
    public function users()
    {
        // Obtiene el usuario autenticado actualmente
        $user = Auth::user();

        // Pasa el usuario autenticado a la vista 'checkout'
        return view('checkout', compact('user'));
    }
    
    public function showCompras()
    {
        // Verificar si hay un usuario autenticado
        if (Auth::check()) {
            // Obtener el ID del usuario autenticado
            $userId = Auth::id();
    
            // Buscar las compras del usuario en la tabla 'productpay' utilizando el campo 'payment_id' y agruparlas por la misma hora de creación
            $compras = ProductPay::where('payment_id', $userId)
                ->get()
                ->groupBy(function ($item) {
                    return $item->created_at->format('Y-m-d');
                });
    
            // Pasar los datos a la vista 'checkcompra'
            return view('checkcompra', compact('compras'));
        }
    
        // Si no hay usuario autenticado, redirigir o mostrar un mensaje de error
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tus compras.');
    }

    public function store(Request $request)
    {
        // Almacenar los datos del comprador en la tabla 'buyers'
        $buyer = new Buyer();
        $buyer->name = $request->input('nombre');
        $buyer->last_name = $request->input('apellidos');
        $buyer->email = $request->input('email');
        $buyer->phone = $request->input('celular');
        $buyer->address = $request->input('direccion');
        $buyer->postal_code = $request->input('codigo_postal');
        $buyer->country = $request->input('pais');
        $buyer->city = $request->input('ciudad');
        $buyer->save();
        
        // Almacenar los detalles de los productos comprados en la tabla 'productpay'
        $productos = $request->input('productos');
        foreach ($productos as $producto) {
            $productPay = new ProductPay();
            $productPay->nameProduct = $producto['nombreProducto'];
            $productPay->quantity = $producto['cantidadProducto'];
            $productPay->amount = $producto['precioProducto'];
            $productPay->payment_id = $request->input('payment_id');
            $productPay->save();
        }
           // Mensaje de éxito en la sesión
           $message = "Formulario enviado exitosamente, por favor procede al pago";
           Session::flash('success_message', $message);

        // Redireccionar después de almacenar los datos
        return redirect()->route('checkoutpay')->with('success', 'Datos de compra almacenados correctamente');
    }
}
