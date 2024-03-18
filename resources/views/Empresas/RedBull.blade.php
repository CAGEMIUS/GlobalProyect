<style>
    .zoom-effect {
        overflow: hidden;
        position: relative;
    }

    .zoom-effect:hover img {
        transform: scale(1.1);
        transition: transform 0.9s ease;
    }

    .card-title {
        text-align: center;
        color: #F0314C;
        font-size: 30px;
    }
</style>

@extends('layouts.compra')

@section('content')
    <div class="container" style="margin-top: 120px; font-size: 20px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/shop">{{ __('Home store') }}</a></li>
                <li class="breadcrumb-item"><a href="/RedBull">{{ __('Shop Red Bull') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Shop') }}</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-7">
                        <h4>{{ __('All brands') }}</h4>
                    </div>
                </div>
                <hr>
                <div class="row">
                    @foreach($products as $pro)
                        @if(isset($pro->empresa) && $pro->empresa->name == 'Red Bull')
                            <div class="col-lg-3">
                                <div class="card zoom-effect" style="margin-bottom: 20px; height: auto; border: 3px solid #F0314C;">
                                    <img src="/uploads/{{ $pro->image}}" class="card-img-top mx-auto" style="height: 150px; width: 150px;display: block;" alt="{{ $pro->image}}">
                                    <div class="card-body">
                                        <a href="#"><h6 class="card-title">{{ $pro->name }}</h6></a>
                                        <p style="font-size: 20px; text-align: center;">${{ $pro->price }} Pesos</p>
                                        <form action="{{ route('cart.store') }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{ $pro->id }}" id="id" name="id">
                                            <input type="hidden" value="{{ $pro->name }}" id="name" name="name">
                                            <input type="hidden" value="{{ $pro->price }}" id="price" name="price">
                                            <input type="hidden" value="{{ $pro->image }}" id="img" name="img">
                                            <input type="hidden" value="{{ $pro->slug }}" id="slug" name="slug">
                                            <input type="hidden" value="1" id="quantity" name="quantity">
                                            <div class="card-footer">
                                                <div class="row justify-content-center">
                                                    <button class="btn btn-secondary btn-sm" style="font-size: 19px; background-color: #F0314C; border: 2px solid black;" class="tooltip-test" title="add to cart">
                                                        <i class="fa fa-shopping-cart"></i> {{ __('Add to cart') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection