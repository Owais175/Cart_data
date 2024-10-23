<?php

namespace App\Http\Controllers;

use App\Models\Coupons;
use Illuminate\Http\Request;

class Couponscontroller extends Controller
{
    function index()
    {
        $Coupons = Coupons::all();
        // dd($Coupons);
        return view('Coupons.index', compact('Coupons'));
    }
    function create()
    {
        return view('Coupons.create');
    }

    function store(Request $request)
    {

        $request->validate([
            'code' => 'required',
            'discount' => 'required',
            'expire_at' => 'required',
        ]);

        Coupons::create([
            'code' => $request->input('code'),
            'discount' => $request->input('discount'),
            'expire_at' => $request->input('expire_at'),
        ]);

        return redirect()->route('Coupons.index');

    }

    function edit($id)
    {
        $Coupons = Coupons::find($id);
        return view('Coupons.edit')->with('Coupons', $Coupons);
    }

    function update(Request $request, $id)
    {
        $Coupons = Coupons::find($id);

        $request->validate([
            'code' => 'required',
            'discount' => 'required',
            'expire_at' => 'required',
        ]);

        $Coupons->update([
            'code' => $request->code,
            'discount' => $request->discount,
            'expire_at' => $request->expire_at
        ]);

        return redirect()->route('Coupons.index', $Coupons->id);
    }

}
