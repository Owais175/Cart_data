<?php

namespace App\Http\Controllers;


use App\Models\Productmodel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Pagecontroller extends Controller
{
    public function index(Request $request)
    {

        $query = $request->input('search');

        if (!empty($query)) {
            $Productmodel = Productmodel::where('product_title', 'LIKE', "%{$query}%")->orWhere('product_description', 'LIKE', "%{$query}%")->paginate(8);
        } else {
            $Productmodel = Productmodel::paginate(8);
        }

        return view('welcome')->with(['Productmodel' => $Productmodel, 'query' => $query]);
    }

    public function details($id)
    {
        $product = DB::table('product')->where('id', $id)->first();
        return view('productdetails', compact('product'));
    }

    public function contact(Request $request)
    {
        return view('contact');
    }
}
