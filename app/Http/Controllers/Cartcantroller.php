<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Models\Tax;
use App\Models\Coupons;
use App\Models\attributes;
use App\Models\Productmodel;
use Illuminate\Http\Request;
use App\Models\product_attributes;


class Cartcantroller extends Controller
{
    public function savecart(Request $request)
    {

        $cart = Session::get('cart', []);

        $id = $request->input('product_id');
        $qty = $request->input('product_qty', 1);
        $color = $request->input('color', null);
        $size = $request->input('size', null);
        $var_item = $request->input('variation', []);
        $product = Productmodel::find($id);


        if (!$product) {
            Session::flash('flash', 'Product Not Found');
            Session::flash('alert-class', 'alert-danger');
            return back();
        }

        if ($id && intval($qty) > 0) {
            if (is_array($cart) && array_key_exists($id, $cart)) {
                unset($cart[$id]);
                // Optionally, update the session with the modified cart
                Session::put('cart', $cart);
            }
        }

        $price = $product->product_price;
        $variation_price = 0;

        if ($color) {
            $color_data = product_attributes::where('product_id', $id)->where('value', $color)->first();
            if ($color_data && $color_data->product_price) {
                $variation_price += $color_data->product_price;
            }
        }

        if ($size) {
            $size_data = product_attributes::where('product_id', $id)->where('value', $size)->first();
            if ($size_data && $size_data->product_price) {
                $variation_price += $size_data->product_price;
            }
        }


        if (auth()->check()) {
            $cart[$id] = [
                'id' => $id,
                'name' => $product->product_title,
                'price' => $price,
                'product_qty' => intval($qty),
                'description' => $product->product_description,
                'image' => $product->product_image,
                'variation_price' => 0,
                'color' => $color,
                'size' => $size,
                'variation' => []
            ];
        } else {
            session()->flash('Success', 'You Have not Login!');
            return redirect()->back();
        }

        // dd($cart);


        foreach ($var_item as $kay => $value) {
            $data = product_attributes::where('porduct_id', $id)->where('value', $value)->first();

            if ($data) {
                $cart[$id]['variation'][$data->id] = [
                    'attributes' => $data->attributes->name,
                    'attributes_val' => $data->attributesvalues->value,
                    'attributes_price' => $data->product_price
                ];
                $cart[$id]['variation_price'] += $data->product_price;
            }
        }

        Session::put('cart', $cart);
        return redirect()->back();

    }


    public function cart()
    {
        $cart = Session::get('cart', []);
        $cartcount = count($cart);
        $language = Session::get('language');
        $product_details = DB::table('product')->first();

        if ($cartcount > 0) {
            return view('cart.cart', [
                'cart' => $cart,
                'cartcount' => $cartcount,
                'language' => $language,
                'product_details' => $product_details
            ]);
        } else {
            return redirect()->back();
        }
    }


    public function removecart($id)
    {
        $cart = Session::get('cart', []);
        $discount = session()->get('discount') ?? 0.0;
        if (isset($cart[$id])) {
            unset($cart[$id]);

            Session::put('cart', $cart);
            Session::forget('discount', $discount);

        }
        return redirect()->route('index');
    }

    public function getcart()
    {
        $cart = Session::get('cart', []);
        $subtotal = 0;

        $cartHtml = view('cart.carts', compact('cart', 'subtotal'))->render();

        return response()->json(['cartHtml' => $cartHtml]);
    }


    public function checkout()
    {
        return view('cart.checkout');
    }

    public function coupons(Request $request)
    {
        $request->validate([
            'code' => 'required|exists:coupons,code',
        ]);

        if ($coupons = Coupons::where('code', $request->code)->where('expire_at', '>', \Carbon\Carbon::now())->first()) {
            $cart = Session::get('cart');
            $subtotal = 0;
            $total_price = 0;

            // Calculate subtotal and total variation price
            foreach ($cart as $pct) {
                $subtotal += $pct['price'] * $pct['product_qty'];
                $total_price += $pct['variation_price'];
            }

            // Apply discount
            $discount = $coupons->discount;
            $total = $subtotal + $total_price;
            $newtotal = $total - ($total * ($discount / 100));

            // Store discount in session
            session()->put('discount', $discount);
            session()->put('newtotal', $newtotal); // Save the updated total in session

            return response()->json([
                'success' => true,
                'newtotal' => number_format($newtotal, 2),
                'discount_amount' => $discount, // Only the percentage discount
                'message' => 'Coupon applied successfully.',
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Invalid or expired coupon code.',
            ]);
        }
    }

}
