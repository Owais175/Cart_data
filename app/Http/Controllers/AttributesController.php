<?php

namespace App\Http\Controllers;

use App\Models\attributes;
use Illuminate\Http\Request;

class AttributesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = attributes::all();
        // dd($attributes);
        return view('attributes.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request);
        $request->validate([
            'code' => 'required',
            'name' => 'required',
        ]);

        $attributes = new attributes;

        $attributes['code'] = $request->input('code');
        $attributes['name'] = $request->input('name');

        $attributes->save();

        session()->flash('Success', 'Attributes Created Successfully');
        return redirect()->route('attributes.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(attributes $attributes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $attributes = attributes::find($id);

        return view('attributes.edit')->with('attributes', $attributes);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'code' => 'required',
            'name' => 'required',
        ]);

        $attributes = attributes::find($id);

        if (!$attributes) {
            return redirect()->route('attributes.index')->withErrors('Attributes Not Found');
        }

        $attributes['code'] = $request->input('code');
        $attributes['name'] = $request->input('name');


        $attributes->save();


        session()->flash('Success', 'Attributes Updated Successfully');
        return redirect()->route('attributes.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $attributes = attributes::find($id);
        attributes::where('id', $id)->delete($attributes);
        session()->flash('Success', 'Attributes Deleted Successfully');
        return redirect()->route('attributes.index');
    }
}


