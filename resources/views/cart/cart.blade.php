@extends('layouts.main')


@section('content')
    <style>
        .cartpg {
            padding: 100px 0;
        }

        .main_cart .table tr td {
            border: 2px solid black;
        }

        .main_cart .table tr th {
            border: 2px solid black;
        }
    </style>

    <section class="cartpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main_cart">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Cart Image</th>
                                    <th>Cart Info</th>
                                    <th>Cart Price</th>
                                    <th>Cart Quntity</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $subtotal = 0;
                                @endphp
                                @if (count($cart) > 0)
                                    @foreach ($cart as $items)
                                        @php
                                            $totalPrice = $items['price'] * $items['product_qty'];
                                            $subtotal += $totalPrice;
                                            $total = $subtotal;
                                        @endphp
                                        <tr>
                                            <td>{{ $items['id'] }}</td>
                                            <td><img src="{{ asset('assets/image/' . $items['image']) }}" alt=""
                                                    style="height: 100px", width="100px"></td>
                                            <td>
                                                <h5>{{ $items['name'] }}</h5> <br>
                                                <p> {{ $items['description'] }}</p>
                                                @if ($items['color'])
                                                    {
                                                    Color {{ $items['color'] }}
                                                    }
                                                @endif
                                                @if ($items['size'])
                                                    {
                                                    Size {{ $items['size'] }}
                                                    }
                                                @endif
                                            </td>
                                            <td>
                                                <p class="price"> ${{ number_format($items['price'], 2) }}</p>
                                            </td>
                                            <td>
                                                <div class="plus-minus counter">
                                                    {{-- <button type="button" class="counter-span decrement"><i
                                                            class="fa-solid fa-minus"></i></button> --}}
                                                    <input class="counter-span count" name="product_qty"
                                                        value="{{ $items['product_qty'] }}" min="1" readonly>
                                                    {{-- <button type="button" class="counter-span increment"><i
                                                            class="fa-solid fa-plus"></i></button> --}}
                                                </div>
                                            </td>
                                            <td class="subtotal">
                                                ${{ number_format($totalPrice, 2) }}
                                            </td>
                                            <td>
                                                <a href="{{ route('removecart', $items['id']) }}"
                                                    class="btn btn-danger">Remove</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5"></td>
                                        <td id="subrow">
                                            <div class="subtotal">
                                                @if (session()->get('cart'))
                                                    <h5>Subtotal: $<span id="total-subtotal"
                                                            class="total-price">{{ $subtotal }}</span>
                                                    </h5>
                                                    <h5>Discount <span class="discount-price">-
                                                            {{ session()->get('discount') ?? 0.0 }}%</span>
                                                    </h5>
                                                    <p>Shipping, taxes, and discounts calculated at checkout.</p>
                                                @else
                                                    <p>Your cart is empty.</p>
                                                @endif
                                            </div>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"></td>
                                        <td colspan="2">
                                            <div class="return-shop">
                                                @if (session()->get('cart'))
                                                    <!-- Apply Coupon Button -->
                                                    <div class="price_get">
                                                        <a href="javascript:void(0)" class="btn btn-primary"
                                                            id="apply-coupon-button">Apply
                                                            Coupon</a>
                                                        <a href="{{ route('cart.checkout') }}"
                                                            class="btn btn-success">Checkout</a>
                                                    </div>
                                                    <!-- Coupon Form (Initially hidden) -->
                                                    <div id="coupon-form" style="display:none; margin-top: 10px;">
                                                        <input type="text" id="coupon-code" class="form-control"
                                                            placeholder="Enter Coupon Code">
                                                        <button class="btn btn-success" id="apply-coupon-submit">Submit
                                                            Coupon</button>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="7">Your Cart Is Empty</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
