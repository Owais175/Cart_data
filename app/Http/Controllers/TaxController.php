<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    function index()
    {
        $tax = Tax::all();
        // dd($tax);
        return view('tax.index', compact('tax'));
    }
    function create()
    {
        return view('tax.create');
    }

    function store(Request $request)
    {
        $request->validate([
            'tax' => 'required',
        ]);

        tax::create([
            'tax' => $request->input('tax'),
        ]);

        return redirect()->route('tax.index');
    }

    function edit($id)
    {
        $tax = Tax::find($id);
        return view('tax.edit')->with('tax', $tax);
    }

    function update(Request $request, $id)
    {
        $tax = Tax::find($id);

        $request->validate([
            'tax' => 'required',
        ]);

        $tax->update([
            'tax' => $request->tax
        ]);

        return redirect()->route('tax.index', $tax->id);
    }

}
