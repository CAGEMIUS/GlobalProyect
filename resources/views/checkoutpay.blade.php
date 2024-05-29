 <!-- Estilos CSS para el botón Paypal-->
 <style>
    .blue-button {
        background-color: blue;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }
</style>

@php
    // SDK de Mercado Pago
    use MercadoPago\MercadoPagoConfig;
    use App\Models\Cart; 
    
    // SDK de Mercado Pago 
    require base_path('vendor/autoload.php');

    //Agregar credenciales
    MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

    $preference = new MercadoPago\Preference();

    foreach ($cartCollection as $product) {
    $item = new MercadoPago\Item();
    $item->title = $product->name;
    $item->quantity = $product->quantity;
    $item->unit_price = $product->price; // Suponiendo que 'price' es el precio unitario del producto
    $item->currency_id = 'COP';

    // Agregar el ítem al array de ítems
    $items[] = $item;
    }


    // Asignar los ítems al atributo 'items' de la preferencia de MercadoPago
    $preference->items = $items;

    $preference->back_urls = array(
        "success" => "http://127.0.0.1:8000/completado",
        "failure" => "http://127.0.0.1:8000/fallo",
    );

    $preference->auto_return = "approved";
    $preference->binary_mode = true;

    $preference->save();

@endphp    


@extends('layouts.ckeckoutPay1')

@section('content')
@include('partials.navbar')
                @if(Session::has('success_message'))
                <div style="margin-top: 150px; font-size: 25px; text-align: center; color: #F0314C; background-color: yellow;">
                    <b>{{ Session::get('success_message') }}</b>
                </div>
                @endif 
        <h1 class="text-center" style="margin-top: 150px;">{{ __('Thank you very much for choosing in Fresh-Drink products 😊') }}</h1>
        <div class="text-center">
            <h2>{{ __('These are the products to purchase') }}</h2>
            <ul class="list-group">
                @foreach(\Cart::getContent() as $item)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="fonst-b col-lg-3">
                                <img src="/uploads/{{ $item->attributes->image }}" style="width: 50px; height: 150px;">
                            </div>
                            <div class="fonst-b col-lg-6">
                                <b>{{ $item->name }}</b>
                                <br><small>{{ __('Quantity: ') }} {{ $item->quantity }}</small>
                            </div>
                            <div class="fonst-b col-lg-3">
                                <p>{{ __('Price: ') }} ${{ number_format(\Cart::get($item->id)->getPriceSum() , 2, ',', '.') }} Pesos</p>
                            </div>
                        </div>
                    </li>
                @endforeach
                <li class="list-group-item text-center"><b>{{ __('Total: ') }} </b> $ {{ number_format(\Cart::getTotal(), 2, ',', '.') }} Pesos</li>
            </ul>
             <!-- Aqui ve el div del paypal que lo tengo en el block de notas -->
        <div class="mt-4">
            <div class="cho-container mx-auto">
                
            </div>
        </div>
    </div>
    
    <script>
        const mp = new MercadoPago("{{config('services.mercadopago.key')}}", {
            locale: 'es-AR'
        });

        mp.checkout({
            preference: {
                id: '{{ $preference->id }}'
            },

            render: {
                container: '.cho-container',
                label: 'Pagar Con Mercado Pago',
            }
        });
    </script>
    
@endsection
