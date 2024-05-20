<style>
    .zoom-effect {
        overflow: hidden;
        position: relative;
    }

    .zoom-effect:hover img {
        transform: scale(1.1);
        transition: transform 0.9s ease;
    }
</style>

@extends('layouts.compra')

@section('content')
    <div class="container" style="margin-top: 120px; font-size: 20px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/shop">{{ __('Home store') }}</a></li>
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
                <div class="teaser content-card">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-md-4 mb-3 mt-3">
                                <div class="card text-center">
                                    <a href="{{ url('/Postobon') }}" class="card-link" data-cmp-data-layer="...">
                                        <div class="zoom-effect">
                                            <img src="{{ asset('img/Empresas/E-postobon.png') }}" class="card-img-top img-fluid d-block" alt="...">
                                        </div>
                                        <div class="card-body text-black">
                                            <h3 class="card-title">Postobon</h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 mt-3">
                                <div class="card text-center">
                                    <a href="{{ url('/RedBull') }}" class="card-link" data-cmp-data-layer="...">
                                        <div class="zoom-effect">
                                            <img src="{{ asset('img/Empresas/E-redbull.png') }}" class="card-img-top img-fluid d-block" alt="...">
                                        </div>
                                        <div class="card-body text-black">
                                            <h3 class="card-title">Red Bull</h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 mt-3">
                                <div class="card text-center">
                                    <a href="{{ url('/Pepsi') }}" class="card-link" data-cmp-data-layer="...">
                                        <div class="zoom-effect">
                                            <img src="{{ asset('img/Empresas/E-pepsi.png') }}" class="card-img-top img-fluid d-block" alt="...">
                                        </div>
                                        <div class="card-body text-black">
                                            <h3 class="card-title">Pepsi</h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 mt-3">
                                <div class="card text-center">
                                    <a href="{{ url('/Manantial') }}" class="card-link" data-cmp-data-layer="...">
                                        <div class="zoom-effect">
                                            <img src="{{ asset('img/Empresas/E-manantialAgua.png') }}" class="card-img-top img-fluid d-block" alt="...">
                                        </div>
                                        <div class="card-body text-black">
                                            <h3 class="card-title">El manantial</h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

