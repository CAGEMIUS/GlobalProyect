@extends('layouts.yourcompra')

@section('content')
    <h1 class="text-center" style="margin-top: 150px;">Fresh-Drink</h1>
    <div class="text-center">
        <h2>{{ __('These are the products you bought') }}</h2>
        @foreach($compras as $fecha => $grupoCompras)
            <div class="mt-4">
                <h3 style="color: #F0314C;">{{ __('Purchases made on') }} {{ $fecha }}</h3>
                <ul class="list-group">
                    @foreach($grupoCompras as $compra)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="font-b col-lg-3">
                                    <b>{{ __('Purchase status:') }}</b>
                                    <p style="background-color: {{ is_null($compra->status) ? 'yellow' : 'green' }}; color: {{ is_null($compra->status) ? 'red' : 'yellow' }};">
                                        {{ $compra->status ?? 'Pendiente en entrega' }}
                                    </p>
                                </div>
                                <div class="font-b col-lg-6">
                                    <b>{{ __('Purchased product:') }}</b>
                                    <p>{{ $compra->nameProduct }}</p>
                                    <small>{{ __('Quantity: ') }} {{ $compra->quantity }}</small>
                                </div>
                                <div class="font-b col-lg-3">
                                    <p>${{ number_format($compra->amount, 2, ',', '.') }} Pesos</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
@endsection