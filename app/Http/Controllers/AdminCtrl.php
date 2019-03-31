<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;


class AdminCtrl extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function adminProduct()
    {
        $tableData = Product::all();
        
        return view('admin_product', array('tableData' => $tableData ));
    }  

    public function productSave(Request $request){
        $product = new Product;
        $product->product_name = $request->input('product_name');
        $product->quantity_in_stock = $request->input('quantity_in_stock');
        $product->price_per_item = $request->input('price_per_item');
        $product->save();

        return "sucess.";
    }
}
