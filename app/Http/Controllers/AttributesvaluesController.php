<?php

namespace App\Http\Controllers;

use App\Models\attributesvalues;
use Illuminate\Http\Request;

class AttributesvaluesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributesvalues = attributesvalues::all();
        // dd($attributesvalues);
        return view('attributesvalues.index', compact('attributesvalues'));
    }


    public function getattributes(Request $request)
    {
        $value = $request->value;



    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('attributesvalues.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request);
        $request->validate([
            'attributes_id' => 'required',
            'value' => 'required',
        ]);

        $attributesvalues = new attributesvalues;


        $attributesvalues['attributes_id'] = $request->input('attributes_id');
        $attributesvalues['value'] = $request->input('value');


        $attributesvalues->save();

        session()->flash('Success', 'attributesvalues Created Successfully');
        return redirect()->route('attributesvalues.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(attributesvalues $attributesvalues)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $attributesvalues = attributesvalues::find($id);

        return view('attributesvalues.edit')->with('attributesvalues', $attributesvalues);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'attributes_id' => 'required',
            'value' => 'required',
        ]);

        $attributesvalues = attributesvalues::find($id);

        if (!$attributesvalues) {
            return redirect()->route('attributesvalues.index')->withErrors('attributesvalues Not Found');
        }

        $attributesvalues['attributes_id'] = $request->input('attributes_id');
        $attributesvalues['value'] = $request->input('value');


        $attributesvalues->save();


        session()->flash('Success', 'attributesvalues Updated Successfully');
        return redirect()->route('attributesvalues.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $attributesvalues = attributesvalues::find($id);
        attributesvalues::where('id', $id)->delete($attributesvalues);
        session()->flash('Success', 'attributesvalues Deleted Successfully');
        return redirect()->route('attributesvalues.index');
    }
}
