<style>
    .boton{
        font-size: 19px; 
        background-color: #F0314C; 
        border: 2px solid black;
    }
</style>

@extends('layouts.compra')

@section('content')
    <div class="container" style="margin-top: 120px; font-size: 20px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/shop">{{ __('Shop') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Your shopping cart') }}</li>
            </ol>
        </nav>
        @if(session()->has('success_msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if(session()->has('alert_msg'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session()->get('alert_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endforeach
        @endif
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center">
                <br>
                @if(\Cart::getTotalQuantity()>0)
                    <h4>{{ \Cart::getTotalQuantity()}} {{ __('Product(s) in cart') }}</h4><br>
                @else
                    <h4>{{ __('No Product(s) In Your Cart 🫣') }}</h4><br>
                    <a href="/shop" class="btn btn-dark">{{ __('Continue in store') }}</a>
                @endif

                @foreach($cartCollection as $item)
                    <div class="row">
                        <div class="col-lg-3">
                            <img src="/uploads/{{ $item->attributes->image }}" class="img-thumbnail" width="200" height="200">
                        </div>
                        <div class="col-lg-5">
                            <p>
                                <b class="card-title"><a href="/shop/{{ $item->attributes->slug }}">{{ $item->name }}</a></b><br>
                                <b>{{ __('Price: ') }} </b>${{ $item->price }} Pesos<br>
                                <b>{{ __('Sub Total: ') }}</b>${{ \Cart::get($item->id)->getPriceSum() }} Pesos<br>
                                <b>{{ __('Available Stock: ') }}</b>{{ $productsStock[$item->id] }} units
                                {{-- <b>With Discount: </b>${{ \Cart::get($item->id)->getPriceSumWithConditions() }} --}}
                            </p>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <form action="{{ route('cart.update') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <input type="hidden" value="{{ $item->id }}" name="id">
                                        <input type="number" class="form-control form-control-sm" value="{{ $item->quantity }}" name="quantity" style="width: 70px; margin-right: 10px;">
                                        <button type="submit" class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i> {{ __('Update Quantity') }}</button>
                                    </div>
                                </form>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $item->id }}" name="id">
                                    <button class="btn btn-dark btn-sm"><i class="fa fa-trash"></i> {{ __('Remove') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
                @if(count($cartCollection)>0)
                    <form action="{{ route('cart.clear') }}" method="POST">
                        {{ csrf_field() }}
                        <button class="boton btn btn-outline-warning btn-md text-light">{{ __('Delete entire cart') }}</button> 
                    </form>
                @endif
            </div>
            @if(count($cartCollection)>0)
                <div class="col-lg-5">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>{{ __('Total: ') }} </b>${{ \Cart::getTotal() }} Pesos</li>
                        </ul>
                    </div>
                    <br>
                    <a href="/shop" class="boton btn btn-outline-primary text-light">{{ __('Continue in store') }}</a>
                    @guest
                        <a href="/checkout" class="boton btn btn-success" data-toggle="modal" data-target="#customAlertModal">{{ __('Proceed to Checkout') }}</a>
                        <!-- Modal para la alerta personalizada -->
                        <div class="modal fade" id="customAlertModal" tabindex="-1" aria-labelledby="customAlertModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="customAlertModalLabel">You need to be logged in</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        You need to be logged in to proceed to checkout.
                                    </div>
                                    <div class="modal-footer">
                                        <a href="/login" class="btn btn-primary">Login</a>
                                        <a href="/register" class="btn btn-secondary">Register</a>
                                    </div>
                                </div>
                            </div>
                    @else
                        <a href="/checkout" class="boton btn btn-success">{{ __('Proceed to Checkout') }}</a>
                    @endguest
                </div>
            @endif
        </div>
        <br><br>
    </div>
@endsection
