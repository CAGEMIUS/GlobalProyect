<style>
    .fonst{
        text-align: center;
        font-size: 20px;
        color: black;
    }

    .fonst-a{
        font-size: 20px;
        color: black;
    }

    .fonst-b{
        margin-top: 30px;
        font-size: 20px;
        text-align: center;
        color: black;
    }

    .boton{
        font-size: 19px; 
        background-color: #F0314C; 
        border: 2px solid black;
    }
</style>
@if(count(\Cart::getContent()) > 0)
    @foreach(\Cart::getContent() as $item)
        <li class="list-group-item">
            <div class="row">
                <div class="col-lg-3">
                    <img src="/uploads/{{ $item->attributes->image }}"
                         style="width: 50px; height: 150px;"
                    >
                </div>
                <div class="fonst-b col-lg-6">
                    <b>{{$item->name}}</b>
                    <br><small>{{ __('Quantity: ') }} {{$item->quantity}}</small>
                </div>
                <div class=" fonst-b col-lg-3">
                    <p><b>{{ __('Price: ') }}</b> ${{ number_format(\Cart::get($item->id)->getPriceSum(), 2, ',', '.') }} Pesos</p>
                </div>
                <hr>
            </div>
        </li>
    @endforeach
    <br>
    <li class="list-group-item">
        <div class="row">
            <div class="fonst-a col-lg-10">
                <b>{{ __('Total: ') }} </b>${{ number_format(\Cart::getTotal(), 2, ',', '.') }} Pesos
            </div>
            <div class="col-lg-2">
                <form action="{{ route('cart.clear') }}" method="POST">
                    {{ csrf_field() }}
                    <button class="btn btn-secondary btn-sm"><i class="fa fa-trash"></i></button>
                </form>
            </div>
        </div>
    </li>
    <br>
    <div class="row" style="margin: 0px;">
        <a class="boton btn btn-dark btn-sm btn-block"  
            href="{{ route('cart.index') }}">
            {{ __('You shopping cart') }} <i class="fa fa-arrow-right"></i>
        </a>
    </div>
@else
    <li class="fonst list-group-item"> {{ __('Your cart is empty 😭') }}</li>
@endif
