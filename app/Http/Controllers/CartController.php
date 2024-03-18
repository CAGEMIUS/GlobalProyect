<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    //Vista de la tienda
    public function shop()
    {
        $products = Product::all();
       //dd($products);
        return view('shop')->withTitle('E-COMMERCE STORE | SHOP')->with(['products' => $products]);
    }

    //Vista postobon
    public function postobon()
    {
        $products = Product::all();
        // dd($products); // Esto te permite verificar los productos obtenidos

        // Pasar la variable $products a la vista 'Postobon'
        return view('Empresas.Postobon')->withTitle('E-COMMERCE STORE | Postobon')->with(['products' => $products]);
    }

    //Vista Red Bull
    public function redbull()
    {
        $products = Product::all();
        // dd($products); // Esto te permite verificar los productos obtenidos

        // Pasar la variable $products a la vista 'Postobon'
        return view('Empresas.RedBull')->withTitle('E-COMMERCE STORE | Postobon')->with(['products' => $products]);
    }

    public function cart() 
    {
        $cartCollection = \Cart::getContent();
        $productsStock = []; // Array para almacenar el stock disponible de cada producto en el carrito
    
        // Obtener el stock disponible de cada producto en el carrito
        foreach ($cartCollection as $item) {
            $product = Product::find($item->id);
            $productsStock[$item->id] = $product->stock;
        }
    
        return view('cart')->withTitle('E-COMMERCE STORE | CART')->with(compact('cartCollection', 'productsStock'));
    }

    public function remove(Request $request)
    {
        // Obtener el producto y su id
        $productId = $request->id;
    
        // Obtener el stock original del producto de la sesión
        $originalStock = session('original_stock_' . $productId);
    
        // Restaurar el stock al valor original
        $product = Product::findOrFail($productId);
        $product->stock = $originalStock;
        $product->save();
    
        // Eliminar el producto del carrito
        \Cart::remove($productId);
    
        // Eliminar la clave de la sesión
        session()->forget('original_stock_' . $productId);
    
        return redirect()->route('cart.index')->with('success_msg', 'El producto fue eliminado y el stock ha sido restaurado');
    }

    public function add(Request$request)
    {
        // Obtener el producto
        $product = Product::findOrFail($request->id);
    
        // Obtener el stock original del producto
        $originalStock = $product->stock;
    
        // Agregar el producto al carrito
        \Cart::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->img,
                'slug' => $request->slug,
                'original_stock' => $originalStock // Almacena el stock original en los atributos del producto en el carrito
            )
        ));
    
        // Restar 1 al stock original del producto
        $product->stock -= 1;
    
        // Guardar el producto actualizado en la base de datos
        $product->save();
    
        // Almacena el stock original en la sesión
        session(['original_stock_' . $request->id => $originalStock]);
    
        return redirect()->route('cart.index')->with('success_msg', 'Producto Agregado a su Carrito!');
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
    
        // Obtén el producto y su stock actual
        $product = Product::findOrFail($id);
        $currentStock = $product->stock;
    
        // Obtén la cantidad actual del producto en el carrito
        $cartItem = \Cart::get($id);
        $currentQuantity = $cartItem->quantity;
    
        // Determina la diferencia entre la cantidad actual y la cantidad deseada
        $quantityDifference = $quantity - $currentQuantity;
    
        // Verifica si la cantidad deseada es mayor que cero
        if ($quantity > 0) {
            // Si la cantidad deseada es mayor que la cantidad actual en el carrito, resta del stock
            if ($quantityDifference > 0) {
                // Verifica si hay suficiente stock disponible
                if ($currentStock < $quantityDifference) {
                    return redirect()->route('cart.index')->with('alert_msg', 'La cantidad solicitada excede el stock disponible');
                }
    
                // Resta del stock
                $product->stock -= $quantityDifference;
            } 
            // Si la cantidad deseada es menor que la cantidad actual en el carrito, suma al stock
            elseif ($quantityDifference < 0) {
                // Suma al stock
                $product->stock += abs($quantityDifference);
            }
    
            // Actualiza la cantidad del producto en el carrito
            \Cart::update($id, [
                'quantity' => array(
                    'relative' => false,
                    'value' => $quantity,
                ),
            ]);
    
            // Guarda los cambios en el producto
            $product->save();
    
            return redirect()->route('cart.index')->with('success_msg', 'El carrito fue actualizado exitosamente');
        } else {
            return redirect()->route('cart.index')->with('alert_msg', 'La cantidad deseada debe ser mayor que cero');
        }
    }

    public function clear()
    {
        // Obtener los elementos del carrito
        $cartItems = \Cart::getContent();
        
        // Recorrer los elementos del carrito
        foreach ($cartItems as $item) {
            // Obtener el producto y su id
            $productId = $item->id;
    
            // Obtener el stock original del producto de la sesión
            $originalStock = session('original_stock_' . $productId);
    
            // Obtener el producto y su cantidad actual en el carrito
            $product = Product::findOrFail($productId);
            $currentQuantity = $item->quantity;
    
            // Restaurar el stock al valor original
            $product->stock = $originalStock;
            $product->save();
            
            // Eliminar la clave de la sesión
            session()->forget('original_stock_' . $productId);
        }
    
        // Limpiar el carrito
        \Cart::clear();
    
        return redirect()->route('cart.index')->with('success_msg', 'El carrito ha sido limpiado y el stock ha sido restaurado');
    }
}