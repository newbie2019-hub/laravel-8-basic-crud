<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductController extends Controller
{
    //
    public function index()
    {
       return Products::paginate(5);
    }

    public function store(Request $request)
    {
        Products::create([
            'name' => $request->name,
            'qty' => $request->qty
        ]);

        return response()->json(['msg'=>'success']);
    }
    public function update(Request $request)
    {
        $products = [
            'name' => $request->name,
            'qty' => $request->qty
        ];

        return Products::where('id', $request->id)->update($products);
    }
    public function delete(Request $request)
    {
        Products::where('id',$request->id)->delete();
        return response()->json(['status'=>'Product Deleted!']);
    }

}
