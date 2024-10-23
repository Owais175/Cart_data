@extends('layouts.main')

@section('content')
    <section class="checkoutpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="info_check text-center">
                        <h1>Checkout</h1>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="checkout_form">
                        <div class="info_check">
                            <h1>Personal Information</h1>
                        </div>
                        <form action="{{ route('ordercart') }}" method="POST" id="payment-form">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <label>Name<span>*</span></label>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" name="fname" required>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" name="lname" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label>Email <span>*</span></label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label>Phone <span>*</span></label>
                                    <input type="text" class="form-control" name="phone" required>
                                </div>
                            </div>
                            <!-- Create Account Checkbox -->
                            <div class="row mb-3 mt-3">
                                <div class="col-12">
                                    <label><input type="checkbox" name="create_account" value="1"> Create an
                                        Account?</label>
                                </div>
                            </div>
                            <!-- Password Fields (Will be displayed if Create Account is selected) -->
                            <div class="row password-fields hidden">
                                <div class="col-12">
                                    <label>Password <span>*</span></label>
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Enter Password">
                                </div>
                                <div class="col-12">
                                    <label>Confirm Password <span>*</span></label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        placeholder="Confirm Password">
                                </div>
                            </div>
                            <div class="row">
                                <div class="info_check">
                                    <h1>Shipping Address</h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label>Address <span>*</span></label>
                                    <input type="text" class="form-control" name="address" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label>City <span>*</span></label>
                                    <input type="text" class="form-control" name="city" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label>Country <span>*</span></label>
                                    <input type="text" class="form-control" name="country" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label>State <span>*</span></label>
                                    <input type="text" class="form-control" name="state" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label>Zip Code<span>*</span></label>
                                    <input type="number" class="form-control" name="zip" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label>Payment Method <span>*</span></label>
                                    <select class="form-control" name="payment_method" required>
                                        <option value="">Select Method</option>
                                        <option value="paypal">PayPal</option>
                                        <option value="cash">Cash on Delivery</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row stripe-token hidden">
                                <div class="col-12">
                                    <label>Card Details <span>*</span></label>
                                    <div id="card-element" class="form-control">
                                        <!-- A Stripe Element will be inserted here -->
                                    </div>
                                    <div id="card-errors" role="alert"></div>
                                </div>
                            </div>
                            <div class="button-sub">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="info_check">
                        <h1>Your Order</h1>
                        <div class="cart_payment">
                            @if (!empty($cart) && count($cart) > 0)
                                <ul>
                                    @php
                                        $count = 1;
                                    @endphp
                                    @foreach ($cart as $item)
                                        <li>
                                            <h2>{{ $count }}: {{ $item['name'] }}
                                                <span>{{ $item['product_qty'] }} x
                                                    ${{ $item['price'] }}</span>
                                            </h2>
                                        </li>
                                        @php
                                            $count += 1;
                                        @endphp
                                    @endforeach
                                </ul>
                                @php
                                    $discount = session()->get('discount') ?? 0.0;
                                @endphp
                                <h5>Total Price: <span>${{ $subtotal }}</span></h5>
                                <h5>Discount:<span>{{ $discount }}%</span></h5>
                                <h5>Tax:<span> ${{ $taxamount }}/({{ $taxrate }}%)</span></h5>
                                <h5>Shipping: <span>${{ $shipping }}</span></h5>
                                <h5>Total: <span>${{ $total }}</span></h5>
                            @else
                                <p>Your cart is empty.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.querySelector('input[name="create_account"]').addEventListener('change', function() {
            document.querySelector('.password-fields').classList.toggle('hidden', !this.checked);
        });

        document.querySelector('select[name="payment_method"]').addEventListener('change', function() {
            const isPayPal = this.value === "paypal";
            const isCash = this.value === "cash";

            document.querySelector('.stripe-token').classList.toggle('hidden', !isPayPal);

            if (isCash) {
                document.getElementById('card-errors').textContent = ''; // Clear card errors if any
            }
        });

        const stripe = Stripe(
            'pk_test_51Q30GeK8nDMM6M1rFyz3zsjv8EGcvxdjpNP62fzY0O878mSY0VN06qO2VQqq6bkikX9HpZy9z4cmKxwDb0z2LOlA00be9f6wmY'
        ); // Replace with your Stripe public key
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const paymentMethod = document.querySelector('select[name="payment_method"]').value;

            // Handle Stripe payment only if the selected method is PayPal
            if (paymentMethod === "paypal") {
                document.querySelector('button[type="submit"]').disabled = true;
                // Disable the submit button to prevent repeated clicks

                const {
                    token,
                    error
                } = await stripe.createToken(cardElement);

                if (error) {
                    // Show error in #card-errors
                    document.getElementById('card-errors').textContent = error.message;
                    document.querySelector('button[type="submit"]').disabled =
                        false; // Re-enable the submit button
                } else {
                    // Append the token to the form and submit it
                    const hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', token.id);
                    form.appendChild(hiddenInput);

                    form.submit();
                }
            } else {
                // If Cash on Delivery or another non-Stripe method is selected, submit the form directly
                form.submit();
            }
        });
    </script>
@endsection
