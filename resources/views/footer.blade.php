<footer>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <div class="footer-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li>
                            <a href="#">About</a>
                        </li>
                        <li>
                            <a href="#">Services</a>
                        </li>
                        <li>
                            <a href="#">Blogs</a>
                        </li>
                        <li>
                            <a href="#">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-3">
                <div class="footer-links">
                    <h4>Services</h4>
                    <ul>
                        <li>
                            <a href="#">Lorem ipsum dolor sit amet.</a>
                        </li>
                        <li>
                            <a href="#">Lorem ipsum dolor sit amet.</a>
                        </li>
                        <li>
                            <a href="#">Lorem ipsum dolor sit amet.</a>
                        </li>
                        <li>
                            <a href="#">Lorem ipsum dolor sit amet.</a>
                        </li>
                        <li>
                            <a href="#">Lorem ipsum dolor sit amet.</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-3">
                <div class="footer-links">
                    <h4>Contact Us</h4>
                    <ul>
                        <li>
                            <a href="tel:+(256) 878-1447">Phone: (256) 878-1447</a>
                        </li>
                        <li>
                            <a href="#">Street: 3146 Kemper Lane</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-3">
                <div class="footer-links social_links">
                    <h4>Social Links</h4>
                    <ul>
                        <li>
                            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="copy_right">
                    <p>© 2024 All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Optional JavaScript; choose one of the two! -->


<!-- Modal start -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">SEARCH PRODUCTS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('index') }}" class="form_search" method="GET">
                    <div class="form_div">
                        <input type="text" name="search" class="form-control"
                            value="{{ request()->input('search') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Modal end -->


<!-- side modal -->

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">SHOPPING CART</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="cart_data">

            @php
                $cart = Session::get('cart', []); // Get the cart or empty array
                $subtotal = 0;
            @endphp

            @if (!empty($cart))
                @foreach ($cart as $item)
                    @php
                        $product = App\Models\Productmodel::find($item['id']);
                        $totalPrice = $item['price'] * $item['product_qty'];
                        $subtotal += $totalPrice;
                    @endphp
                    <div class="shoping_data main_cart d-flex mb-3">
                        <a href="{{ route('removecart', $item['id']) }}" class="cut_btn"><i
                                class="fa-solid fa-xmark"></i></a>
                        <div class="flex_cart">
                            <img src="{{ asset('assets/image/' . $item['image']) }}" alt="{{ $item['name'] }}"
                                style="height: 100px; width: 100px;">
                        </div>
                        <div class="cart_details ms-3">
                            <h5>{{ $item['name'] }}</h5>
                            <div class="cartqty">
                                <p>Quantity: <span>{{ $item['product_qty'] }}</span></p>
                            </div>
                            <p>Price: <span class="price">${{ number_format($item['price'], 2) }}</span></p>
                            <div class="plus-minus counter">
                                <button type="button" class="counter-span decrement"><i
                                        class="fa-solid fa-minus"></i></button>
                                <input class="counter-span count" name="product_qty" value="{{ $item['product_qty'] }}"
                                    min="1" readonly>
                                <button type="button" class="counter-span increment"><i
                                        class="fa-solid fa-plus"></i></button>
                            </div>
                            <p>Total: <span class="subtotal">${{ number_format($totalPrice, 2) }}</span></p>
                        </div>
                    </div>
                @endforeach

                <div class="subrow mt-3">
                    <h5 id="subrow">Subtotal: $ <span id="total-subtotal">{{ number_format($subtotal, 2) }}</span>
                    </h5>
                </div>

                <div class="show_pg mt-4">
                    <a href="{{ route('cart.checkout') }}" class="btn btn-danger">Proceed to Checkout</a>
                </div>
            @else
                <div class="empty_cart">
                    <img src="{{ asset('assets/image/empty_cart.png') }}" class="img-fluid" alt="">
                    <p class="mt-3">Your cart is empty!</p>
                </div>
            @endif
        </div>
    </div>
</div>





<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"
    integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ url('assets/js/custom.js') }}"></script>

<script>
    // Show coupon form when apply coupon button is clicked
    document.getElementById('apply-coupon-button').addEventListener('click', function() {
        document.getElementById('coupon-form').style.display = 'block';
    });

    // Apply coupon via AJAX when submit button is clicked
    document.getElementById('apply-coupon-submit').addEventListener('click', function() {
        document.getElementById('coupon-form').style.display = 'none';
        var couponCode = document.getElementById('coupon-code').value;

        if (couponCode) {
            // Send AJAX request to apply coupon
            fetch('{{ route('couponsapply') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        code: couponCode
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update subtotal and discount price dynamically
                        document.getElementById('total-subtotal').textContent = data.newtotal;
                        document.querySelector('.discount-price').textContent = '-' + data.discount_amount +
                            '%';
                        alert('Coupon applied successfully!');
                    } else if (data.message) {
                        document.getElementById('coupon-form').style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error applying coupon');
                });
        } else {
            alert('Please enter a coupon code');
        }
    });
</script>



@if (Session::has('message'))
    <script type="text/javascript">
        toastr.success("{{ Session::get('message') }}");
    </script>
@endif
