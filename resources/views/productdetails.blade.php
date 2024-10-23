@extends('layouts.main')

@section('content')
    <section class="product-details">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    @if (session()->has('Success'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session()->get('Success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                <div class="col-6">
                    <div class="porduct_img">
                        <figure>
                            <img src="{{ asset('assets/image/' . $product->product_image) }}" class="img-fluid"
                                alt="">
                        </figure>
                    </div>
                </div>
                <div class="col-6">
                    <div class="porduct_img">
                        <form action="{{ route('savecart') }}" id="addToCartForm">
                            @csrf
                            <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
                            <h1>{{ $product->product_title }}</h1>
                            <p>Price :{{ $product->product_price }}$</p>
                            <p>{{ $product->product_description }}</p>
                            <div class="plus-minus counter">
                                <button type="button" class="counter-span decrement"><i
                                        class="fa-solid fa-minus"></i></button>
                                <input class="counter-span count" name="product_qty" value="1" min="1" readonly>
                                <button type="button" class="counter-span increment"><i
                                        class="fa-solid fa-plus"></i></button>
                            </div>
                            <button type="submit" class="btn btn-success">ADD TO CART</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        // JavaScript/jQuery for handling form submission
        $(document).ready(function() {
            $('#addToCartForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                let product_id = $('#product_id').val();
                let product_qty = $('.count').val();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        // Show notification (e.g., using Bootstrap Toast)
                        alert('Product added to cart successfully!');

                        // Update the cart in the offcanvas modal
                        updatecart();
                    },
                    error: function(xhr, stauts, error) {
                        // Handle error case (e.g., product not added to cart)
                        alert('An error occurred' + xhr.responseText);
                    }
                });
            });

            function updatecart() {
                $.ajax({
                    url: "{{ route('getcart') }}",
                    method: "GET",
                    success: function(response) {
                        $('.cart_data').html(response);
                    }
                    error: function(xhr, stauts, error) {
                        console.log('Error Fatch Cart: ' + xhr.responseText);

                    }
                });
            }
        });
    </script>
@endsection
