@extends('layouts.main')



@section('content')
    @foreach ($cart as $item)
        @php
            $product = App\Models\Productmodel::find($item['id']);
            $totalPrice = $item['price'] * $item['product_qty'];
            $subtotal += $totalPrice;
        @endphp
        <div class="shoping_data d-flex mb-3">
            <div class="flex_cart">
                <img src="{{ asset('assets/image/' . $item['image']) }}" alt="{{ $item['name'] }}"
                    style="height: 100px; width: 100px;">
            </div>
            <div class="cart_details ms-3">
                <h5>{{ $item['name'] }}</h5>
                <p>Quantity: <span>{{ $item['product_qty'] }}</span></p>
                <p>Price: <span>${{ number_format($item['price'], 2) }}</span></p>
                <p>Total: <span>${{ number_format($totalPrice, 2) }}</span></p>
            </div>
        </div>
    @endforeach

    <div class="subtotal mt-3">
        <h5>Subtotal: ${{ number_format($subtotal, 2) }}</h5>
    </div>

    <div class="show_pg mt-4">
        <a href="{{ route('cart.cart') }}" class="btn btn-danger">Proceed to Checkout</a>
    </div>
@endsection
