<?php

namespace App\Http\Controllers;
use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Tax;
use App\Models\User;
use Stripe\Customer;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Pymentcontroller extends Controller
{

    public function checkout()
    {
        $cart = Session::get('cart');

        // Get the first product (optional, depending on your needs)
        $product = DB::table('product')->first();

        if ($cart && count($cart) > 0) {
            // Calculate subtotal
            $subtotals = collect($cart)->sum(fn($item) => $item['price'] * $item['product_qty']);


            // Example: Assume a flat shipping rate of $10 or calculate dynamically
            $shipping = 15;
            $discount = session()->get('discount') ?? 0.0;
            $discount_amount = $subtotals * ($discount / 100);
            $subtotals = $subtotals - $discount_amount;

            // Tax Calculate
            $tax = Tax::first();
            $totaltax = $tax ? $tax->tax : 0;
            $taxamount = $subtotals * ($totaltax / 100);
            // Calculate the total (subtotals + shipping)
            $totals = $subtotals + $shipping + $taxamount;

            // Format for display purposes
            $subtotal = number_format($subtotals, 2);
            $total = number_format($totals, 2);


            // Pass the necessary data to the view, including cart items and calculated totals
            return view('cart.checkout', [
                'cart' => $cart,
                // 'countries' => $countries,
                'product' => $product,
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'total' => $total,
                'taxrate' => $totaltax,
                'taxamount' => number_format($taxamount, 2),

            ]);
        } else {
            // If the cart is empty, flash a message and redirect
            Session::flash('flash_message', 'No Product Found');
            Session::flash('alert-class', 'alert-success');
            return redirect('/');
        }
    }

    public function getstate(Request $request)
    {
        $state = DB::table('state')->where('country_id', $request->country_id)->get();
        echo json_encode(array("state" => $state));
    }
    public function getcity(Request $request)
    {
        $city = DB::table('city')->where('state_id', $request->state_id)->get();
        echo json_encode(array("city" => $city));
    }

    public function ordercart(Request $request)
    {

        $request->validate([
            "fname" => 'required',
            "lname" => 'required',
            "email" => 'required|email|max:250|unique:users',
            "phone" => 'required',
            "address" => 'required|max:150',
            "city" => 'required',
            "country" => 'required',
            "state" => 'required',
            "zip" => 'required|max:10',
            'payment_method' => 'required',
            'stripeToken' => 'nullable',
        ]);

        $userid = Auth::check() ? Auth::user()->id : 0;

        if ($request->has('create_account') && !$userid) {
            $request->validate([
                'password' => 'required|min:6|confirmed',
            ]);

            $user = User::create([
                'name' => $request->fname . '' . $request->lname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'password_confirmation' => Hash::make($request->password_confirmation),
            ]);

            $userid = $user->id;
        }

        $cart = Session::get('cart');
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty or invalid');
        }
        $subtotals = collect($cart)->sum(fn($item) => $item['price'] * $item['product_qty']);
        $shipping = Session::get('shipping', 15);
        $discount = session()->get('discount') ?? 0.0;
        $discount_amount = $subtotals * ($discount / 100);
        $subtotals = $subtotals - $discount_amount;

        // Tax Calculate
        $tax = Tax::first();
        $totaltax = $tax ? $tax->tax : 0;
        $taxamount = $subtotals * ($totaltax / 100);

        $totals = $subtotals + $shipping + $taxamount;


        // Don't format numbers for database insertion
        $subtotal = $subtotals; // Keep it as raw numeric value for the database
        $total = $totals;       // Keep it as raw numeric value for the database


        $order = Order::create([
            'user_id' => $userid,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'state' => $request->state,
            'zip' => $request->zip,
            'order_items' => is_array($cart) ? count($cart) : 0,
            'order_item_total' => $subtotal,
            'order_shipping' => $shipping,
            'order_total' => $total,
            'payment_method' => $request->payment_method,
            'discount' => $discount,
            'tax' => $totaltax,
        ]);

        if ($request->payment_method === 'paypal') {
            $order->update([
                'transaction_id' => $request->payment_id,
                'order_status' => $request->payment_status ?? 'pending',
            ]);
        } elseif ($request->payment_method === 'cash') {
            $order->update(['order_status' => 'succeeded']);
        } elseif ($request->payment_method === 'stripe' && $request->stripeToken) {
            try {
                Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

                $customer = \Stripe\Customer::create([
                    'email' => $request->email,
                    'source' => $request->stripeToken,
                ]);

                $charge = \Stripe\Charge::create([
                    'customer' => $customer->id,
                    'amount' => $total * 100,
                    'currency' => 'USD',
                    'description' => 'Order payment',
                ]);

                $chargeJson = $charge->jsonSerialize();
                if ($chargeJson['paid']) {
                    $order->update([
                        'transaction_id' => $chargeJson['balance_transaction'],
                        'order_status' => $chargeJson['status'] ?? 'pending',
                    ]);
                }
            } catch (\Exception $e) {
                return back()->with('stripe_error', $e->getMessage());
            }
        }

        $cart = $cart ?? [];

        if (is_array($cart) || is_object($cart)) {
            foreach ($cart as $item) {
                OrderProduct::create([
                    'orders_id' => $order->id,
                    'order_products_product_id' => $item['id'],
                    'order_products_name' => $item['name'],
                    'order_products_price' => $item['price'],
                    'order_products_qty' => $item['product_qty'],
                    'order_products_subtotal' => $item['price'] * $item['product_qty'],
                    'variants' => json_encode(value: $item['variation']),
                ]);
            }
        } else {
            echo "Cart is empty or invalid";
        }
        Session::forget('cart');
        Session::forget('discount');
        return redirect()->route('index')->with('success', 'Your Order has been placed Successfully');
    }
}
