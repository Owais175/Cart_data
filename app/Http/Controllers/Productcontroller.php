<?php

namespace App\Http\Controllers;

use App\Models\Productmodel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller;




class Productcontroller extends Controller
{
    public function index()
    {
        $Productmodel = Productmodel::all();
        return view('product.index', compact('Productmodel'));
    }
    public function create()
    {
        return view('product.create');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'product_title' => 'required',
            'product_price' => 'required',
            'product_qty' => 'required',
            'product_image' => 'required|image|mimes:jpeg,jpg,png,gif,webp|max:' . (50 * 1024),
            'product_description' => 'required',
        ]);

        $imagename = null;

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/image'), $imagename);
        }


        Productmodel::create([
            'product_title' => $request->input('product_title'),
            'product_price' => $request->input('product_price'),
            'product_qty' => $request->input('product_qty'),
            'product_description' => $request->input('product_description'),
            'product_image' => $imagename,
        ]);
        session()->flash('Success', 'Product Created Successfully');
        return redirect()->route('product.create');
    }


    public function edit($id)
    {
        $Productmodel = Productmodel::find($id);
        return view('product.edit')->with('Productmodel', $Productmodel);
    }

    public function update(Request $request, $id)
    {

        $Productmodel = Productmodel::find($id);

        $request->validate([
            'product_title' => 'required',
            'product_price' => 'required',
            'product_qty' => 'required',
            'product_description' => 'required',
        ]);

        if ($request->hasFile('product_image')) {
            // Delete old image if it exists
            if ($Productmodel->product_image && file_exists(public_path('assets/image/' . $Productmodel->product_image))) {
                unlink(public_path('assets/image/' . $Productmodel->product_image));
            }

            // Store new image
            $image = $request->file('product_image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/image'), $imagename);
            $Productmodel->product_image = $imagename;
        }


        $Productmodel->update([
            'product_title' => $request->product_title,
            'product_price' => $request->product_price,
            'product_qty' => $request->product_qty,
            'product_description' => $request->product_description,
        ]);

        session()->flash('Success', 'Product Updated Successfully');
        return redirect()->route('product.edit', $Productmodel->id);
    }

    public function destroy($id)
    {

        $Productmodel = Productmodel::find($id);

        if ($Productmodel) {

            if (!is_null($Productmodel->product_image)) {

                $imagepath = 'assets/image/' . $Productmodel->product_image;

                if (file_exists($imagepath)) {
                    if (unlink($imagepath)) {
                        session()->flash('Success', 'Product Image Deleted Successfully');
                    } else {
                        session()->flash('Error', 'Failed to Delete Product Image');
                    }
                } else {
                    session()->flash('Error', 'Product Image Not Found');
                }

            }

            $Productmodel->delete();
            session()->flash('Success', 'Product Deleted Successfully');
            return redirect()->route('product.index');
        }

    }
}
