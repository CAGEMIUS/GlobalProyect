@extends('layouts.pedidos')

@section('content')
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
            <!-- Formulario para detalles del usuario -->
            <div class="mt-5">
                <form method="post" action="{{ route('datos.store') }}">
                    @csrf
                    <button style="font-size: 25px;" type="button" class="btn btn-primary" onclick="mostrarFormulario()">{{ __('Click here to fill out the purchase form') }}</button>

                    <!-- Aquí se muestra el formulario oculto hasta que se haga clic en el botón -->
                    <div id="formularioPago" style="display: none;">
                        <!-- Campos para detalles del usuario -->
                        <div class="form-group" style="margin-top: 50px;" >
                            <label for="nombre"><b>{{ __('Name:') }}</b></label>
                            <div class="col-lg-3 mx-auto">
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="{{ __('Enter your full name') }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="apellidos"><b>{{ __('Last name:') }}</b></label>
                            <div class="col-lg-3 mx-auto">
                                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="{{ __('Enter your last name') }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3 mx-auto">
                                @if(isset($user))
                                    <label for="email"><b>{{ __('Email:') }}</b></label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('Enter your last name') }}"
                                        value="{{ old('email', $user->email) }}" autocomplete="email" required>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="celular"><b>{{ __('Cell number:') }}</b></label>
                            <div class="col-lg-3 mx-auto">
                                <input type="tel" class="form-control" id="celular" name="celular" placeholder="{{ __('Enter your phone number') }}" required> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="direccion"><b>{{ __('Address:') }}</b></label>
                            <div class="col-lg-3 mx-auto">
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="{{ __('Enter your residential address') }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="codigo_postal"><b>{{ __('Postal code:') }}</b></label>
                            <div class="col-lg-3 mx-auto">
                                <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" placeholder="{{ __('Enter your postal code') }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pais"><b>{{ __('Country:') }}</b></label>
                            <div class="col-lg-3 mx-auto">
                                <input type="text" class="form-control" id="pais" name="pais" placeholder="{{ __('Enter the country where you live') }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ciudad"><b>{{ __('City:') }}</b></label>
                            <div class="col-lg-3 mx-auto">
                                <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="{{ __('Enter the city where you live') }}"required>
                            </div>
                        </div>
                        <input type="hidden" id="payment_id" name="payment_id" value="{{Auth::id()}}">
                        <!-- Iterar sobre los elementos del carrito y enviar detalles de cada producto -->
                        @foreach(Cart::getContent() as $item)
                            <input type="hidden" name="productos[{{ $loop->index }}][imageProducto]" value="/uploads/{{ $item->attributes->image }}">
                            <input type="hidden" name="productos[{{ $loop->index }}][nombreProducto]" value="{{ $item->name }}">
                            <input type="hidden" name="productos[{{ $loop->index }}][cantidadProducto]" value="{{ $item->quantity }}">
                            <input type="hidden" name="productos[{{ $loop->index }}][precioProducto]" value="{{ $item->price }}">
                        @endforeach
                        <input style="margin-top: 20px; background-color: blue; color: white; font-size: 20px; " type="submit" name="submit" value="{{ __('Submit and Save Data') }}" />
                    </div>
                </form>
            </div>
        </div>
    </div>
     <!-- JavaScript para mostrar u ocultar el formulario y el botón "Pay Now" -->
     <script>
        function mostrarFormulario() {
            var formulario = document.getElementById('formularioPago');
            formulario.style.display = 'block';
        }
    </script>
    
@endsection
